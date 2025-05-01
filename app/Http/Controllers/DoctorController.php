<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:doctors,email',
            'phone'             => 'nullable|string|max:20',
            'gender'            => 'nullable|string|max:10',
            'qualification'     => 'nullable|string|max:255',
            'specialization'    => 'nullable|string|max:255',
            'department'        => 'nullable|string|max:255',
            'profile_photo'     => 'nullable|string|max:255',
            'address'           => 'nullable|string|max:255',
            'date_of_joining'   => 'nullable|date',
            'experience'        => 'nullable|integer|min:0',
            'is_available'      => 'nullable|boolean',
            'room_number'       => 'nullable|string|max:50',
            'timing'            => 'nullable|string|max:50',
            'consultation_fee'  => 'nullable|numeric|min:0',
            'bio'               => 'nullable|string',
            'license_number'    => 'nullable|string|max:100',
            'created_by'        => 'nullable|integer',
            'updated_by'        => 'nullable|integer',
            'status'            => 'nullable|string|max:20',
        ]);

        $validated['uuid'] = Str::uuid();
        $validated['is_available'] = $request->has('is_available') ? (bool)$request->input('is_available') : true;
        $validated['status'] = $validated['status'] ?? 'active';

        Doctor::create($validated);
        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:doctors,email,' . $doctor->id,
            'phone'             => 'nullable|string|max:20',
            'gender'            => 'nullable|string|max:10',
            'qualification'     => 'nullable|string|max:255',
            'specialization'    => 'nullable|string|max:255',
            'department'        => 'nullable|string|max:255',
            'profile_photo'     => 'nullable|string|max:255',
            'address'           => 'nullable|string|max:255',
            'date_of_joining'   => 'nullable|date',
            'experience'        => 'nullable|integer|min:0',
            'is_available'      => 'nullable|boolean',
            'room_number'       => 'nullable|string|max:50',
            'timing'            => 'nullable|string|max:50',
            'consultation_fee'  => 'nullable|numeric|min:0',
            'bio'               => 'nullable|string',
            'license_number'    => 'nullable|string|max:100',
            'created_by'        => 'nullable|integer',
            'updated_by'        => 'nullable|integer',
            'status'            => 'nullable|string|max:20',
        ]);

        $validated['is_available'] = $request->has('is_available') ? (bool)$request->input('is_available') : true;
        $validated['status'] = $validated['status'] ?? 'active';

        $doctor->update($validated);
        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
