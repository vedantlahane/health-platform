<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Device Data Details</h1>
            <a href="{{ route('device-data.index') }}" class="bg-gray-100 hover:bg-gray-200 text-blue-600 px-4 py-2 rounded-lg font-semibold shadow transition">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="bg-white p-8 rounded-2xl shadow-xl mb-10 max-w-2xl mx-auto">
        <h2 class="text-xl font-bold mb-4">
            Patient: {{ $deviceData->patient?->name ?? 'Unknown' }}
        </h2>
        
        <div class="mb-4"><span class="font-semibold">Device Type:</span> {{ $deviceData->device_type }}</div>
        <div class="mb-4"><span class="font-semibold">Recorded At:</span> {{ $deviceData->recorded_at ? \Carbon\Carbon::parse($deviceData->recorded_at)->format('d M Y, H:i') : '-' }}</div>
        <div class="mb-4"><span class="font-semibold">Billable:</span>
            @if($deviceData->is_billable)
                <span class="inline-block px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Yes</span>
            @else
                <span class="inline-block px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">No</span>
            @endif
        </div>
        <div class="mb-4"><span class="font-semibold">General Unit:</span> {{ $deviceData->unit ?? '-' }}</div>
        <div class="mb-4">
            <span class="font-semibold">Readings:</span>
            <div class="mt-2">
                @foreach(is_array($deviceData->data) ? $deviceData->data : [] as $key => $value)
                    <div class="mb-1">
                        <span class="inline-block bg-blue-100 text-blue-800 rounded px-2 py-1 text-xs font-semibold mr-1">
                            {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
        @if($deviceData->notes)
            <div class="mb-4">
                <span class="font-semibold">Notes:</span>
                <div class="bg-gray-50 p-3 rounded mt-1">{{ $deviceData->notes }}</div>
            </div>
        @endif
        <div class="flex justify-end mt-6">
            <a href="{{ route('device-data.edit', ['device_datum' => $deviceData->id]) }}">Edit</a>

            <form action="{{ route('device-data.destroy', ['device_datum' => $deviceData]) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-lg font-semibold shadow transition"
                        onclick="return confirm('Are you sure you want to delete this record?')">
                    Delete
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
