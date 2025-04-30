<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Schedule New Appointment</h1>
        <p class="text-gray-600">Book a new appointment for a patient.</p>
    </x-slot>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST" class="bg-white p-8 rounded-2xl shadow-xl mb-10">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="font-semibold">Patient</label>
                <select name="patient_id" class="border p-2 w-full rounded" required>
                    <option value="">Select Patient</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" @selected(old('patient_id') == $patient->id)>{{ $patient->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Department / Specialization</label>
                <select name="specialization" class="border p-2 w-full rounded" id="specialization-select" required>
                    <option value="">Select Specialization</option>
                    @foreach($specializations as $spec)
                        <option value="{{ $spec }}" @selected(old('specialization') == $spec)>{{ $spec }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Assigned Doctor</label>
                <select name="doctor_id" class="border p-2 w-full rounded" id="doctor-select" required>
                    <option value="">Select Doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}"
                            data-specialization="{{ $doctor->specialization }}"
                            @selected(old('doctor_id') == $doctor->id)
                        >
                            {{ $doctor->name }} ({{ $doctor->specialization }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Appointment Date & Time</label>
                <input type="datetime-local" name="appointment_time" value="{{ old('appointment_time') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Status</label>
                <select name="status" class="border p-2 w-full rounded" required>
                    <option value="scheduled" @selected(old('status') == 'scheduled')>Scheduled</option>
                    <option value="completed" @selected(old('status') == 'completed')>Completed</option>
                    <option value="cancelled" @selected(old('status') == 'cancelled')>Cancelled</option>
                </select>
            </div>
            <div>
                <label class="font-semibold">Type</label>
                <select name="type" class="border p-2 w-full rounded">
                    <option value="">Select Type</option>
                    <option value="consultation" @selected(old('type') == 'consultation')>Consultation</option>
                    <option value="follow-up" @selected(old('type') == 'follow-up')>Follow-up</option>
                    <option value="procedure" @selected(old('type') == 'procedure')>Procedure</option>
                </select>
            </div>
        </div>
        <div class="mt-6">
            <label class="font-semibold">Reason for Appointment</label>
            <input type="text" name="reason" value="{{ old('reason') }}" class="border p-2 w-full rounded" required>
        </div>
        <div class="mt-6">
            <label class="font-semibold">Notes</label>
            <textarea name="notes" class="border p-2 w-full rounded" rows="3">{{ old('notes') }}</textarea>
        </div>
        <div class="flex justify-end mt-8">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold shadow transition">
                Schedule Appointment
            </button>
        </div>
    </form>

    <script>
        // Optional: Filter doctors by specialization
        document.getElementById('specialization-select').addEventListener('change', function() {
            var selectedSpec = this.value;
            var doctorSelect = document.getElementById('doctor-select');
            Array.from(doctorSelect.options).forEach(function(option) {
                if (!option.value) return; // Skip placeholder
                option.style.display = option.getAttribute('data-specialization') === selectedSpec ? '' : 'none';
            });
            doctorSelect.value = '';
        });
    </script>
</x-app-layout>
