<?php

namespace App\Http\Controllers;

use App\Models\DeviceData;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeviceDataController extends Controller
{
    public function index()
    {
        $deviceData = DeviceData::with(['patient', 'appointment'])->latest('recorded_at')->get();
        return view('device-data.index', compact('deviceData'));
    }

    public function create()
    {
        $patients = Patient::all();
        $appointments = Appointment::all();
        return view('device-data.create', compact('patients', 'appointments'));
    }

    public function store(Request $request)
    {
        // Decode JSON string to array before validation
        $dataArray = json_decode($request->input('data'), true);
        if (!is_array($dataArray)) {
            return back()->withInput()->withErrors(['data' => 'Invalid device data.']);
        }
        $request->merge(['data' => $dataArray]);

        $validated = $request->validate([
            'patient_id'      => 'required|exists:patients,id',
            'appointment_id'  => 'nullable|exists:appointments,id',
            'device_type'     => 'required|string|max:100',
            'data'            => 'required|array',
            'unit'            => 'nullable|string|max:50',
            'recorded_at'     => 'required|date',
            'notes'           => 'nullable|string',
            'is_billable'     => 'sometimes|boolean',
        ]);

        $validated['uuid'] = Str::uuid();
        $validated['is_billable'] = $request->has('is_billable') ? (bool)$request->input('is_billable') : false;
        $validated['billed'] = false;
        $validated['billed_in_invoice_id'] = null;

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
        $appointments = Appointment::all();
        return view('device-data.edit', compact('deviceData', 'patients', 'appointments'));
    }

    public function update(Request $request, DeviceData $deviceData)
    {
        // Decode JSON string to array before validation
        $dataArray = json_decode($request->input('data'), true);
        if (!is_array($dataArray)) {
            return back()->withInput()->withErrors(['data' => 'Invalid device data.']);
        }
        $request->merge(['data' => $dataArray]);

        $validated = $request->validate([
            'patient_id'      => 'required|exists:patients,id',
            'appointment_id'  => 'nullable|exists:appointments,id',
            'device_type'     => 'required|string|max:100',
            'data'            => 'required|array',
            'unit'            => 'nullable|string|max:50',
            'recorded_at'     => 'required|date',
            'notes'           => 'nullable|string',
            'is_billable'     => 'sometimes|boolean',
        ]);

        $validated['is_billable'] = $request->has('is_billable') ? (bool)$request->input('is_billable') : false;
        // Don't reset billed/billed_in_invoice_id here

        $deviceData->update($validated);
        return redirect()->route('device-data.index')->with('success', 'Device data updated successfully.');
    }

    public function destroy(DeviceData $deviceData)
    {
        $deviceData->delete();
        return redirect()->route('device-data.index')->with('success', 'Device data deleted successfully.');
    }
}
