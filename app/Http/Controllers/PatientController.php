<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    // Display all patients
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    // Show the form for creating a new patient
    public function create()
    {
        return view('patients.create');
    }

    // Store a new patient
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'nullable|string|max:20',
            'dob' => 'required|date',
            'gender' => 'required',
            'blood_group' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
            'family_history' => 'nullable|string',
            'social_history' => 'nullable|string',
            'emergency_contact' => 'nullable|string|max:50',
            'insurance' => 'nullable|string|max:100',
            'last_visit' => 'nullable|date',
            'medical_history' => 'nullable|string',
        ]);

        $validated['uuid'] = Str::uuid();

        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }

    // Show a single patient
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    // Show the form for editing a patient
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    // Update an existing patient
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email,' . $patient->id,
            'phone' => 'nullable|string|max:20',
            'dob' => 'required|date',
            'gender' => 'required',
            'blood_group' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
            'family_history' => 'nullable|string',
            'social_history' => 'nullable|string',
            'emergency_contact' => 'nullable|string|max:50',
            'insurance' => 'nullable|string|max:100',
            'last_visit' => 'nullable|date',
            'medical_history' => 'nullable|string',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    // Delete a patient
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }
}
