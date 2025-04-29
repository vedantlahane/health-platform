<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-4">Appointments</h1>
    </x-slot>

    <a href="{{ route('appointments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add Appointment</a>
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="py-2 px-4">Patient</th>
                <th class="py-2 px-4">Doctor</th>
                <th class="py-2 px-4">Time</th>
                <th class="py-2 px-4">Status</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($appointments as $appointment)
            <tr>
                <td class="py-2 px-4">{{ $appointment->patient->name }}</td>
                <td class="py-2 px-4">{{ $appointment->doctor->name }}</td>
                <td class="py-2 px-4">{{ $appointment->appointment_time }}</td>
                <td class="py-2 px-4">{{ ucfirst($appointment->status) }}</td>
                <td class="py-2 px-4">
                    <a href="{{ route('appointments.edit', $appointment) }}" class="text-yellow-600">Edit</a> |
                    <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600" onclick="return confirm('Delete appointment?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>
