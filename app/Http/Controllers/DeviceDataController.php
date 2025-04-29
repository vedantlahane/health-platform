<?php

namespace App\Http\Controllers;

use App\Models\DeviceData;
use App\Models\Patient;
use Illuminate\Http\Request;

class DeviceDataController extends Controller
{
    public function index()
    {
        $deviceData = DeviceData::with('patient')->get();
        return view('device-data.index', compact('deviceData'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('device-data.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'device_type' => 'required|string',
            'reading_value' => 'required|string',
            'unit' => 'nullable|string',
            'recorded_at' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        DeviceData::create($validated);
        return redirect()->route('device-data.index')->with('success', 'Device data recorded successfully.');
    }

    public function show(DeviceData $deviceData)
    {
        return view('device-data.show', compact('deviceData'));
    }

    public function edit(DeviceData $deviceData)
    {
        $patients = Patient::all();
        return view('device-data.edit', compact('deviceData', 'patients'));
    }

    public function update(Request $request, DeviceData $deviceData)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'device_type' => 'required|string',
            'reading_value' => 'required|string',
            'unit' => 'nullable|string',
            'recorded_at' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $deviceData->update($validated);
        return redirect()->route('device-data.index')->with('success', 'Device data updated successfully.');
    }

    public function destroy(DeviceData $deviceData)
    {
        $deviceData->delete();
        return redirect()->route('device-data.index')->with('success', 'Device data deleted successfully.');
    }
}
