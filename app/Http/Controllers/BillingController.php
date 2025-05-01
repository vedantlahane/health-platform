<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BillingController extends Controller
{
    public function index()
    {
        $billings = Billing::with(['patient', 'appointment'])->latest()->get();
        return view('billing.index', compact('billings'));
    }

    public function create(Request $request)
    {
        $patients = Patient::all();
        $appointments = Appointment::where('status', 'completed')
            ->doesntHave('billing')
            ->with('doctor')
            ->get();
            
        $selectedPatient = null;
        $selectedAppointment = null;
        $defaultItems = [];
        $subtotal = 0;
        
        // Handle appointment selection
        if ($request->has('appointment_id')) {
            $selectedAppointment = Appointment::with(['doctor', 'patient'])
                ->findOrFail($request->appointment_id);
            $selectedPatient = $selectedAppointment->patient;
            
            // Add consultation fee as default item
            if ($selectedAppointment->doctor && $selectedAppointment->doctor->consultation_fee) {
                $defaultItems[] = [
                    'name' => 'Consultation with Dr. ' . $selectedAppointment->doctor->name,
                    'quantity' => 1,
                    'unit_price' => $selectedAppointment->doctor->consultation_fee
                ];
                $subtotal += $selectedAppointment->doctor->consultation_fee;
            }
        }
        // Handle patient selection without appointment
        elseif ($request->has('patient_id')) {
            $selectedPatient = Patient::findOrFail($request->patient_id);
        }
        
        return view('billing.create', compact(
            'patients', 
            'appointments', 
            'selectedPatient', 
            'selectedAppointment',
            'defaultItems',
            'subtotal'
        ));
    }

    public function show(Billing $billing)
    {
        return view('billing.show', compact('billing'));
    }

    public function edit(Billing $billing)
    {
        $patients = Patient::all();
        $appointments = Appointment::where('status', 'completed')
            ->orWhere('id', $billing->appointment_id)
            ->with('doctor')
            ->get();
            
        return view('billing.edit', compact('billing', 'patients', 'appointments'));
    }

    public function store(Request $request)
    {
        $items = json_decode($request->input('items'), true);

        if (!is_array($items) || count($items) == 0) {
            return back()->withInput()->withErrors(['items' => 'Please add at least one item/service.']);
        }

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'payment_method' => 'required|string',
            'tax' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        foreach ($items as $item) {
            if (
                empty($item['name']) ||
                !isset($item['quantity']) || $item['quantity'] < 1 ||
                !isset($item['unit_price']) || $item['unit_price'] < 0
            ) {
                return back()->withInput()->withErrors(['items' => 'Invalid item details.']);
            }
        }

        $subtotal = collect($items)->sum(function($item) {
            return $item['quantity'] * $item['unit_price'];
        });
        $tax = $request->input('tax', 0);
        $discount = $request->input('discount', 0);
        $total = $subtotal + $tax - $discount;

        $billing = Billing::create([
            'uuid' => Str::uuid(),
            'patient_id' => $validated['patient_id'],
            'appointment_id' => $request->input('appointment_id'),
            'invoice_number' => 'INV-' . now()->format('Ymd') . '-' . rand(1000, 9999),
            'items' => $items,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'discount' => $discount,
            'total' => $total,
            'payment_method' => $validated['payment_method'],
            'paid_at' => now(),
            'description' => $validated['description'] ?? null,
        ]);

        // Mark appointment as invoiced
        if ($billing->appointment) {
            $billing->appointment->update(['status' => 'invoiced']);
        }

        return redirect()->route('billing.index')->with('success', 'Billing created successfully.');
    }

    public function update(Request $request, Billing $billing)
    {
        $items = json_decode($request->input('items'), true);

        if (!is_array($items) || count($items) == 0) {
            return back()->withInput()->withErrors(['items' => 'Please add at least one item/service.']);
        }

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'payment_method' => 'required|string',
            'tax' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        foreach ($items as $item) {
            if (
                empty($item['name']) ||
                !isset($item['quantity']) || $item['quantity'] < 1 ||
                !isset($item['unit_price']) || $item['unit_price'] < 0
            ) {
                return back()->withInput()->withErrors(['items' => 'Invalid item details.']);
            }
        }

        $subtotal = collect($items)->sum(function($item) {
            return $item['quantity'] * $item['unit_price'];
        });
        $tax = $request->input('tax', 0);
        $discount = $request->input('discount', 0);
        $total = $subtotal + $tax - $discount;

        // Handle appointment changes
        $oldAppointmentId = $billing->appointment_id;
        $newAppointmentId = $request->input('appointment_id');
        
        $billing->update([
            'patient_id' => $validated['patient_id'],
            'appointment_id' => $newAppointmentId,
            'items' => $items,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'discount' => $discount,
            'total' => $total,
            'payment_method' => $validated['payment_method'],
            'description' => $validated['description'] ?? null,
        ]);

        // Update appointment statuses if needed
        if ($oldAppointmentId != $newAppointmentId) {
            // Reset old appointment if it exists
            if ($oldAppointmentId) {
                Appointment::where('id', $oldAppointmentId)->update(['status' => 'completed']);
            }
            
            // Mark new appointment as invoiced if it exists
            if ($newAppointmentId) {
                Appointment::where('id', $newAppointmentId)->update(['status' => 'invoiced']);
            }
        }

        return redirect()->route('billing.index')->with('success', 'Billing updated successfully.');
    }

    public function destroy(Billing $billing)
    {
        // Reset appointment status if needed
        if ($billing->appointment) {
            $billing->appointment->update(['status' => 'completed']);
        }
        
        $billing->delete();
        return redirect()->route('billing.index')->with('success', 'Billing deleted successfully.');
    }
}
