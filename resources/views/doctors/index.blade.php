<x-app-layout>
    <x-slot name="header"> 
        <h1 class="text-2xl font-bold mb-4">Doctors</h1>
    </x-slot>

    <a href="{{ route('doctors.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add Doctor</a>
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="py-2 px-4">Name</th>
                <th class="py-2 px-4">Email</th>
                <th class="py-2 px-4">Specialization</th>
                <th class="py-2 px-4">Phone</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
                <tr>
                    <td class="py-2 px-4">{{ $doctor->name }}</td>
                    <td class="py-2 px-4">{{ $doctor->email }}</td>
                    <td class="py-2 px-4">{{ $doctor->specialization }}</td>
                    <td class="py-2 px-4">{{ $doctor->phone }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('doctors.show', $doctor) }}" class="text-blue-600">View</a> |
                        <a href="{{ route('doctors.edit', $doctor) }}" class="text-yellow-600">Edit</a> |
                        <form action="{{ route('doctors.destroy', $doctor) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Delete doctor?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
