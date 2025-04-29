<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Device Data</h1>
            <a href="{{ route('device-data.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Record New Data</a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b text-left">Patient</th>
                    <th class="py-2 px-4 border-b text-left">Device Type</th>
                    <th class="py-2 px-4 border-b text-left">Reading</th>
                    <th class="py-2 px-4 border-b text-left">Recorded At</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deviceData as $data)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $data->patient->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $data->device_type }}</td>
                        <td class="py-2 px-4 border-b">{{ $data->reading_value }} {{ $data->unit }}</td>
                        <td class="py-2 px-4 border-b">{{ $data->recorded_at }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('device-data.show', $data) }}" class="text-blue-500 hover:underline mr-2">View</a>
                            <a href="{{ route('device-data.edit', $data) }}" class="text-yellow-500 hover:underline mr-2">Edit</a>
                            <form action="{{ route('device-data.destroy', $data) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
