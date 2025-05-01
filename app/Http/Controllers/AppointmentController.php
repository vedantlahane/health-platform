<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->latest('appointment_time')->get();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $specializations = Doctor::select('specialization')->distinct()->pluck('specialization');
        return view('appointments.create', compact('patients', 'doctors', 'specializations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'specialization' => 'nullable|string|max:100',
            'appointment_time' => 'required|date|after:now',
            'status' => 'required|string|in:scheduled,completed,cancelled',
            'type' => 'nullable|string|max:50',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Prevent double-booking for doctor at the same time
        $exists = Appointment::where('doctor_id', $validated['doctor_id'])
            ->where('appointment_time', $validated['appointment_time'])
            ->whereNull('deleted_at')
            ->exists();
        if ($exists) {
            return back()->withInput()->withErrors(['appointment_time' => 'Doctor already has an appointment at this time.']);
        }

        $validated['uuid'] = Str::uuid();
        Appointment::create($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment created!');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $specializations = Doctor::select('specialization')->distinct()->pluck('specialization');
        $appointments = Appointment::all(); // Add this line
    
        return view('appointments.edit', compact('appointment', 'patients', 'doctors', 'specializations', 'appointments'));
    }
    

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'specialization' => 'nullable|string|max:100',
            'appointment_time' => 'required|date|after:now',
            'status' => 'required|string|in:scheduled,completed,cancelled',
            'type' => 'nullable|string|max:50',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Prevent double-booking for doctor at the same time (ignore self)
        $exists = Appointment::where('doctor_id', $validated['doctor_id'])
            ->where('appointment_time', $validated['appointment_time'])
            ->where('id', '!=', $appointment->id)
            ->whereNull('deleted_at')
            ->exists();
        if ($exists) {
            return back()->withInput()->withErrors(['appointment_time' => 'Doctor already has an appointment at this time.']);
        }

        $appointment->update($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated!');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted!');
    }
}
