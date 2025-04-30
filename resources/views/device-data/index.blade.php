<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Device Data Records</h1>
            <a href="{{ route('device-data.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow transition">
                + Record New Data
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-xl shadow-lg border border-gray-200">
            <thead class="bg-blue-50 border-b border-blue-100 text-blue-800">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold">Patient</th>
                    <th class="py-3 px-4 text-left font-semibold">Device Type</th>
                    <th class="py-3 px-4 text-left font-semibold">Readings</th>
                    <th class="py-3 px-4 text-left font-semibold">Recorded At</th>
                    <th class="py-3 px-4 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deviceData as $data)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="py-2 px-4 border-b font-medium text-gray-900">{{ $data->patient->name }}</td>
                        <td class="py-2 px-4 border-b text-gray-700">{{ $data->device_type }}</td>
                        <td class="py-2 px-4 border-b">
                            @foreach($data->data as $key => $value)
                                <span class="inline-block bg-blue-100 text-blue-800 rounded px-2 py-1 text-xs font-semibold mr-1 mb-1">
                                    {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value }}
                                </span>
                            @endforeach
                        </td>
                        <td class="py-2 px-4 border-b text-gray-700">{{ \Carbon\Carbon::parse($data->recorded_at)->format('d M Y, H:i') }}</td>
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
