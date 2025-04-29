<x-app-layout>
    <x-slot name="header"> 
        <h1 class="text-2xl font-bold mb-6">Create New Invoice</h1>
    </x-slot>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('billing.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="patient_id" class="block text-gray-700 font-bold mb-2">Patient</label>
            <select name="patient_id" id="patient_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select Patient</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="invoice_number" class="block text-gray-700 font-bold mb-2">Invoice Number</label>
            <input type="text" name="invoice_number" id="invoice_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="INV-{{ date('Ymd') }}-{{ rand(1000, 9999) }}">
        </div>

        <div class="mb-4">
            <label for="amount" class="block text-gray-700 font-bold mb-2">Amount</label>
            <input type="number" step="0.01" name="amount" id="amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="unpaid">Unpaid</option>
                <option value="paid">Paid</option>
                <option value="partial">Partially Paid</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="due_date" class="block text-gray-700 font-bold mb-2">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Create Invoice
            </button>
            <a href="{{ route('billing.index') }}" class="text-blue-500 hover:underline">Cancel</a>
        </div>
    </form>
</x-app-layout>
