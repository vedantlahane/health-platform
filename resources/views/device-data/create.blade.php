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

    <form action="{{ route('device-data.store') }}" method="POST" id="device-data-form">
        @csrf
        <div class="mb-4">
            <label for="patient_id" class="block text-gray-700 font-bold mb-2">Patient</label>
            <select name="patient_id" id="patient_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Select Patient</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="device_type" class="block text-gray-700 font-bold mb-2">Device Type</label>
            <select name="device_type" id="device_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Select Device</option>
                <option value="Blood Pressure">Blood Pressure</option>
                <option value="Heart Rate">Heart Rate</option>
                <option value="Temperature">Temperature</option>
                <option value="Blood Glucose">Blood Glucose</option>
                <option value="Oxygen Saturation">Oxygen Saturation</option>
                <option value="ECG">ECG</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="mb-4" id="device-fields">
            <!-- Dynamic fields will appear here -->
        </div>

        <input type="hidden" name="data" id="data-json">

        <div class="mb-4">
            <label for="unit" class="block text-gray-700 font-bold mb-2">General Unit (optional)</label>
            <input type="text" name="unit" id="unit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="recorded_at" class="block text-gray-700 font-bold mb-2">Recorded At</label>
            <input type="datetime-local" name="recorded_at" id="recorded_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
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

    <script>
        const deviceFields = {
            "Blood Pressure": [
                { label: "Systolic (mmHg)", id: "systolic", type: "number" },
                { label: "Diastolic (mmHg)", id: "diastolic", type: "number" },
                { label: "Pulse (bpm)", id: "pulse", type: "number" }
            ],
            "Heart Rate": [
                { label: "Heart Rate (bpm)", id: "heart_rate", type: "number" }
            ],
            "Temperature": [
                { label: "Temperature (°C)", id: "temperature", type: "number", step: "0.1" }
            ],
            "Blood Glucose": [
                { label: "Glucose (mg/dL)", id: "glucose", type: "number" }
            ],
            "Oxygen Saturation": [
                { label: "SpO2 (%)", id: "spo2", type: "number" },
                { label: "Pulse Rate (bpm)", id: "pulse_rate", type: "number" }
            ],
            "ECG": [
                { label: "ECG Result", id: "ecg_result", type: "text" }
            ],
            "Other": [
                { label: "Reading Name", id: "other_name", type: "text" },
                { label: "Reading Value", id: "other_value", type: "text" }
            ]
        };

        function renderDeviceFields(type) {
            let html = '';
            if (deviceFields[type]) {
                deviceFields[type].forEach(field => {
                    html += `<label class="block text-gray-700 font-bold mb-2">${field.label}</label>
                        <input type="${field.type}" ${field.step ? `step="${field.step}"` : ''} id="${field.id}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-4 leading-tight focus:outline-none focus:shadow-outline">`;
                });
            }
            document.getElementById('device-fields').innerHTML = html;
        }

        document.getElementById('device_type').addEventListener('change', function() {
            renderDeviceFields(this.value);
        });

        // Before submit, gather all device-specific fields into JSON
        document.getElementById('device-data-form').addEventListener('submit', function(e) {
            const type = document.getElementById('device_type').value;
            let data = {};
            if (deviceFields[type]) {
                deviceFields[type].forEach(field => {
                    data[field.id] = document.getElementById(field.id)?.value;
                });
            }
            document.getElementById('data-json').value = JSON.stringify(data);
        });
    </script>
</x-app-layout>
