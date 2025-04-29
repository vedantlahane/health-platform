<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor; // ✅ Add this

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
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:doctors,email',
        'specialization' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'experience' => 'required|integer|min:0',
    ]);
    Doctor::create($validated);
    return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
}

public function update(Request $request, Doctor $doctor)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:doctors,email,' . $doctor->id,
        'specialization' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'experience' => 'required|integer|min:0',
    ]);
    $doctor->update($validated);
    return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
}


    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }



    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
