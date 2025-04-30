<x-app-layout>
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
