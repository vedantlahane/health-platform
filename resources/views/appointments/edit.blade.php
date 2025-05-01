<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Edit Appointment</h1>
        <p class="text-gray-600">Update appointment details and status.</p>
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

    <form action="{{ route('appointments.update', $appointment) }}" method="POST" class="bg-white p-8 rounded-2xl shadow-xl mb-10">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="font-semibold">Patient</label>
                <select name="patient_id" class="border p-2 w-full rounded" required>
                    <option value="">Select Patient</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" @selected(old('patient_id', $appointment->patient_id) == $patient->id)>{{ $patient->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Department / Specialization</label>
                <select name="specialization" class="border p-2 w-full rounded" id="specialization-select" required>
                    <option value="">Select Specialization</option>
                    @foreach($specializations as $spec)
                        <option value="{{ $spec }}" @selected(old('specialization', $appointment->specialization) == $spec)>{{ $spec }}</option>
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
                            @selected(old('doctor_id', $appointment->doctor_id) == $doctor->id)
                        >
                            {{ $doctor->name }} ({{ $doctor->specialization }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Appointment Date & Time</label>
                <input type="datetime-local" name="appointment_time"
                       value="{{ old('appointment_time', \Carbon\Carbon::parse($appointment->appointment_time)->format('Y-m-d\TH:i')) }}"
                       class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Status</label>
                <select name="status" class="border p-2 w-full rounded" required>
                    <option value="scheduled" @selected(old('status', $appointment->status) == 'scheduled')>Scheduled</option>
                    <option value="completed" @selected(old('status', $appointment->status) == 'completed')>Completed</option>
                    <option value="cancelled" @selected(old('status', $appointment->status) == 'cancelled')>Cancelled</option>
                </select>
            </div>
            <div>
                <label class="font-semibold">Type</label>
                <select name="type" class="border p-2 w-full rounded">
                    <option value="">Select Type</option>
                    <option value="consultation" @selected(old('type', $appointment->type) == 'consultation')>Consultation</option>
                    <option value="follow-up" @selected(old('type', $appointment->type) == 'follow-up')>Follow-up</option>
                    <option value="procedure" @selected(old('type', $appointment->type) == 'procedure')>Procedure</option>
                </select>
            </div>
        </div>
        <div class="mt-6">
            <label class="font-semibold">Reason for Appointment</label>
            <input type="text" name="reason" value="{{ old('reason', $appointment->reason) }}" class="border p-2 w-full rounded" required>
        </div>
        <div class="mt-6">
            <label class="font-semibold">Notes</label>
            <textarea name="notes" class="border p-2 w-full rounded" rows="3">{{ old('notes', $appointment->notes) }}</textarea>
        </div>
        <div class="flex justify-end mt-8">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold shadow transition">
                Update Appointment
            </button>
        </div>
    </form>

    <script>
        document.getElementById('specialization-select').addEventListener('change', function() {
            var selectedSpec = this.value;
            var doctorSelect = document.getElementById('doctor-select');
            Array.from(doctorSelect.options).forEach(function(option) {
                if (!option.value) return;
                option.style.display = option.getAttribute('data-specialization') === selectedSpec ? '' : 'none';
            });
            // If current doctor is not in the selected specialization, reset selection
            if (doctorSelect.selectedOptions.length && doctorSelect.selectedOptions[0].style.display === 'none') {
                doctorSelect.value = '';<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Appointments</h1>
        <p class="text-gray-600">All appointments, their status, and details.</p>
    </x-slot>

    <a href="{{ route('appointments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg mb-4 inline-block font-semibold shadow transition">
        + Schedule Appointment
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-xl shadow-lg border border-gray-200">
            <thead>
                <tr class="bg-blue-50 border-b border-blue-100 text-blue-800">
                    <th class="py-3 px-4 text-left font-semibold">Patient</th>
                    <th class="py-3 px-4 text-left font-semibold">Doctor</th>
                    <th class="py-3 px-4 text-left font-semibold">Specialization</th>
                    <th class="py-3 px-4 text-left font-semibold">Date & Time</th>
                    <th class="py-3 px-4 text-left font-semibold">Reason</th>
                    <th class="py-3 px-4 text-left font-semibold">Status</th>
                    <th class="py-3 px-4 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="py-2 px-4 font-medium text-gray-900">{{ $appointment->patient->name }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $appointment->doctor->name }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $appointment->doctor->specialization ?? '-' }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('d M Y, H:i') }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $appointment->reason ?? '-' }}</td>
                        <td class="py-2 px-4">
                            <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                                @if($appointment->status == 'scheduled') bg-yellow-100 text-yellow-700
                                @elseif($appointment->status == 'completed') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="py-2 px-4 flex gap-2">
                            <a href="{{ route('appointments.edit', $appointment) }}"
                               class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 text-xs font-semibold"
                               title="Edit">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536M9 11l6 6M12 17h7v-7"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-xs font-semibold"
                                        onclick="return confirm('Delete appointment?')" title="Delete">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 px-4 text-center text-gray-500">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>

            }
        });
        // On page load, trigger change for edit mode or old input
        window.onload = function() {
            document.getElementById('specialization-select').dispatchEvent(new Event('change'));
        };
    </script>
</x-app-layout>
