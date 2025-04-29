<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-4">Patients</h1>
    </x-slot>

    <a href="{{ route('patients.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add Patient</a>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="py-2 px-4">Name</th>
                <th class="py-2 px-4">Email</th>
                <th class="py-2 px-4">DOB</th>
                <th class="py-2 px-4">Gender</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
                <tr>
                    <td class="py-2 px-4">{{ $patient->name }}</td>
                    <td class="py-2 px-4">{{ $patient->email }}</td>
                    <td class="py-2 px-4">{{ $patient->dob }}</td>
                    <td class="py-2 px-4">{{ $patient->gender }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('patients.show', $patient) }}" class="text-blue-600">View</a> |
                        <a href="{{ route('patients.edit', $patient) }}" class="text-yellow-600">Edit</a> |
                        <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Delete patient?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
