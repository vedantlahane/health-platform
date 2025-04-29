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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'invoice_number' => 'required|string|unique:billings',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string',
            'due_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        Billing::create($validated);
        return redirect()->route('billing.index')->with('success', 'Billing created successfully.');
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

    public function update(Request $request, Billing $billing)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'invoice_number' => 'required|string|unique:billings,invoice_number,' . $billing->id,
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string',
            'due_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        $billing->update($validated);
        return redirect()->route('billing.index')->with('success', 'Billing updated successfully.');
    }

    public function destroy(Billing $billing)
    {
        $billing->delete();
        return redirect()->route('billing.index')->with('success', 'Billing deleted successfully.');
    }
}
