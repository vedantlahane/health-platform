<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-6">Record Device Data</h1>
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

    <form class="" action="{{ route('device-data.store') }}" method="POST">
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
            <label for="device_type" class="block text-gray-700 font-bold mb-2">Device Type</label>
            <select name="device_type" id="device_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="Blood Pressure">Blood Pressure</option>
                <option value="Heart Rate">Heart Rate</option>
                <option value="Temperature">Temperature</option>
                <option value="Blood Glucose">Blood Glucose</option>
                <option value="Oxygen Saturation">Oxygen Saturation</option>
                <option value="ECG">ECG</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="reading_value" class="block text-gray-700 font-bold mb-2">Reading Value</label>
            <input type="text" name="reading_value" id="reading_value" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="unit" class="block text-gray-700 font-bold mb-2">Unit</label>
            <input type="text" name="unit" id="unit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="recorded_at" class="block text-gray-700 font-bold mb-2">Recorded At</label>
            <input type="datetime-local" name="recorded_at" id="recorded_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="notes" class="block text-gray-700 font-bold mb-2">Notes</label>
            <textarea name="notes" id="notes" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Save Data
            </button>
            <a href="{{ route('device-data.index') }}" class="text-blue-500 hover:underline">Cancel</a>
        </div>
    </form>
</x-app-layout>
