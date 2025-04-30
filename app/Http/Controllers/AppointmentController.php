<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index() {
        $appointments = Appointment::with(['patient', 'doctor'])->get();
        return view('appointments.index', compact('appointments'));
    }

    public function create() {
        $patients = Patient::all();
        $doctors = Doctor::all();
        // Get unique specializations from doctors
        $specializations = Doctor::select('specialization')->distinct()->pluck('specialization');
        return view('appointments.create', compact('patients', 'doctors', 'specializations'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'specialization' => 'nullable|string|max:100',
            'appointment_time' => 'required|date',
            'status' => 'required|string',
            'type' => 'nullable|string|max:50',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        Appointment::create($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment created!');
    }

    public function show(Appointment $appointment) {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment) {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $specializations = Doctor::select('specialization')->distinct()->pluck('specialization');
        return view('appointments.edit', compact('appointment', 'patients', 'doctors', 'specializations'));
    }

    public function update(Request $request, Appointment $appointment) {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'specialization' => 'nullable|string|max:100',
            'appointment_time' => 'required|date',
            'status' => 'required|string',
            'type' => 'nullable|string|max:50',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        $appointment->update($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment updated!');
    }

    public function destroy(Appointment $appointment) {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted!');
    }
}
