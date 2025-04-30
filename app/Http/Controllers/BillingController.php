<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Patient;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $billings = Billing::with('patient')->get();
        return view('billing.index', compact('billings'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('billing.create', compact('patients'));
    }


    public function show(Billing $billing)
    {
        return view('billing.show', compact('billing'));
    }

    public function edit(Billing $billing)
    {
        $patients = Patient::all();
        return view('billing.edit', compact('billing', 'patients'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'invoice_number' => 'required|string|unique:billings',
        'items' => 'required|array|min:1',
        'items.*.name' => 'required|string',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.unit_price' => 'required|numeric|min:0',
        'tax' => 'nullable|numeric|min:0',
        'discount' => 'nullable|numeric|min:0',
        'status' => 'required|string',
        'payment_method' => 'nullable|string',
        'paid_at' => 'nullable|date',
        'due_date' => 'required|date',
        'description' => 'nullable|string'
    ]);

    // Calculate subtotal, total
    $subtotal = collect($validated['items'])->sum(function($item) {
        return $item['quantity'] * $item['unit_price'];
    });
    $tax = $validated['tax'] ?? 0;
    $discount = $validated['discount'] ?? 0;
    $total = $subtotal + $tax - $discount;

    $validated['subtotal'] = $subtotal;
    $validated['total'] = $total;

    Billing::create($validated);
    return redirect()->route('billing.index')->with('success', 'Billing created successfully.');
}

public function update(Request $request, Billing $billing)
{
    $validated = $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'invoice_number' => 'required|string|unique:billings,invoice_number,' . $billing->id,
        'items' => 'required|array|min:1',
        'items.*.name' => 'required|string',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.unit_price' => 'required|numeric|min:0',
        'tax' => 'nullable|numeric|min:0',
        'discount' => 'nullable|numeric|min:0',
        'status' => 'required|string',
        'payment_method' => 'nullable|string',
        'paid_at' => 'nullable|date',
        'due_date' => 'required|date',
        'description' => 'nullable|string'
    ]);

    $subtotal = collect($validated['items'])->sum(function($item) {
        return $item['quantity'] * $item['unit_price'];
    });
    $tax = $validated['tax'] ?? 0;
    $discount = $validated['discount'] ?? 0;
    $total = $subtotal + $tax - $discount;

    $validated['subtotal'] = $subtotal;
    $validated['total'] = $total;

    $billing->update($validated);
    return redirect()->route('billing.index')->with('success', 'Billing updated successfully.');
}


    public function destroy(Billing $billing)
    {
        $billing->delete();
        return redirect()->route('billing.index')->with('success', 'Billing deleted successfully.');
    }
}
