<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Patients</h1>
        <p class="text-gray-600">All registered patients and their key details.</p>
    </x-slot>

    <a href="{{ route('patients.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg mb-4 inline-block font-semibold shadow transition">
        + Add Patient
    </a>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-xl shadow-lg border border-gray-200">
            <thead>
                <tr class="bg-blue-50 border-b border-blue-100 text-blue-800">
                    <th class="py-3 px-4 text-left font-semibold">Name</th>
                    <th class="py-3 px-4 text-left font-semibold">Email</th>
                    <th class="py-3 px-4 text-left font-semibold">Phone</th>
                    <th class="py-3 px-4 text-left font-semibold">DOB</th>
                    <th class="py-3 px-4 text-left font-semibold">Gender</th>
                    <th class="py-3 px-4 text-left font-semibold">Last Visit</th>
                    <th class="py-3 px-4 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="py-2 px-4 font-medium text-gray-900">{{ $patient->name }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $patient->email }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $patient->phone ?? '-' }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $patient->dob }}</td>
                        <td class="py-2 px-4">
                            @if($patient->gender)
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $patient->gender == 'male' ? 'bg-blue-100 text-blue-700' : ($patient->gender == 'female' ? 'bg-pink-100 text-pink-700' : 'bg-gray-100 text-gray-700') }}">
                                    {{ ucfirst($patient->gender) }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                      
                        <td class="py-2 px-4 text-gray-700">{{ $patient->last_visit ?? '-' }}</td>
                        <td class="py-2 px-4 flex gap-2">
                            <a href="{{ route('patients.show', $patient) }}"
                               class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 text-xs font-semibold"
                               title="View">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                View
                            </a>
                            <a href="{{ route('patients.edit', $patient) }}"
                               class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 text-xs font-semibold"
                               title="Edit">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536M9 11l6 6M12 17h7v-7"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-xs font-semibold"
                                        onclick="return confirm('Delete patient?')" title="Delete">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="py-4 px-4 text-center text-gray-500">No patients found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
