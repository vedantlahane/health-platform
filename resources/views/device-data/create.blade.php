<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-4">Record Device Data</h1>
        <p class="text-gray-600">Enter readings from any medical device, tailored to the device type.</p>
    </x-slot>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('device-data.store') }}" method="POST" id="device-data-form" class="bg-white p-10 rounded-2xl shadow-xl mb-10  mx-auto space-y-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="font-semibold">Patient</label>
                <select name="patient_id" id="patient_id" class="border p-2 w-full rounded" required>
                    <option value="">Select Patient</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Device Type</label>
                <select name="device_type" id="device_type" class="border p-2 w-full rounded" required>
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
        </div>

        <div id="device-fields" class="bg-blue-50 rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Dynamic fields will appear here -->
        </div>

        <input type="hidden" name="data" id="data-json">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="font-semibold">General Unit <span class="text-gray-400">(optional)</span></label>
                <input type="text" name="unit" id="unit" class="border p-2 w-full rounded" placeholder="e.g. mmHg, bpm, °C">
            </div>
            <div>
                <label class="font-semibold">Recorded At</label>
                <input type="datetime-local" name="recorded_at" id="recorded_at" class="border p-2 w-full rounded" required>
            </div>
        </div>

        <div>
            <label class="font-semibold">Notes</label>
            <textarea name="notes" id="notes" rows="3" class="border p-2 w-full rounded" placeholder="Any additional notes..."></textarea>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('device-data.index') }}" class="bg-gray-100 hover:bg-gray-200 text-blue-600 px-6 py-2 rounded-lg font-semibold shadow transition">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg font-bold shadow transition">
                Save Data
            </button>
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
                    html += `<div>
                        <label class="font-semibold">${field.label}</label>
                        <input type="${field.type}" ${field.step ? `step="${field.step}"` : ''} id="${field.id}" class="border p-2 w-full rounded mb-2">
                    </div>`;
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
