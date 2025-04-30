<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Doctors</h1>
        <p class="text-gray-600">All registered doctors and their details.</p>
    </x-slot>

    <a href="{{ route('doctors.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg mb-4 inline-block font-semibold shadow transition">
        + Add Doctor
    </a>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-xl shadow-lg border border-gray-200">
            <thead>
                <tr class="bg-blue-50 border-b border-blue-100 text-blue-800">
                    <th class="py-3 px-4 text-left font-semibold">Photo</th>
                    <th class="py-3 px-4 text-left font-semibold">Name</th>
                    <th class="py-3 px-4 text-left font-semibold">Email</th>
                    <th class="py-3 px-4 text-left font-semibold">Specialization</th>
                    <th class="py-3 px-4 text-left font-semibold">Department</th>
                    <th class="py-3 px-4 text-left font-semibold">Phone</th>
                    <th class="py-3 px-4 text-left font-semibold">Experience</th>
                    <th class="py-3 px-4 text-left font-semibold">Available</th>
                    <th class="py-3 px-4 text-left font-semibold">Room</th>
                    <th class="py-3 px-4 text-left font-semibold">Timing</th>
                    <th class="py-3 px-4 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $doctor)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="py-2 px-4">
                            @if($doctor->profile_photo)
                                <img src="{{ $doctor->profile_photo }}" alt="Photo" class="w-10 h-10 rounded-full object-cover">
                            @else
                                <span class="inline-block w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 font-bold">{{ strtoupper(substr($doctor->name,0,1)) }}</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 font-medium text-gray-900">{{ $doctor->name }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $doctor->email }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $doctor->specialization }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $doctor->department }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $doctor->phone }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $doctor->experience }} yrs</td>
                        <td class="py-2 px-4">
                            @if($doctor->is_available)
                                <span class="inline-block px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Available</span>
                            @else
                                <span class="inline-block px-2 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">Not Available</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 text-gray-700">{{ $doctor->room_number ?? '-' }}</td>
                        <td class="py-2 px-4 text-gray-700">{{ $doctor->timing ?? '-' }}</td>
                        <td class="py-2 px-4 flex gap-2">
                            <a href="{{ route('doctors.show', $doctor) }}"
                               class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 text-xs font-semibold"
                               title="View">
                                View
                            </a>
                            <a href="{{ route('doctors.edit', $doctor) }}"
                               class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 text-xs font-semibold"
                               title="Edit">
                                Edit
                            </a>
                            <form action="{{ route('doctors.destroy', $doctor) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-xs font-semibold"
                                        onclick="return confirm('Delete doctor?')" title="Delete">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="py-4 px-4 text-center text-gray-500">No doctors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
