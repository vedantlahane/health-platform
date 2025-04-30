<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Doctor Details</h1>
        <p class="text-gray-600">Profile and schedule information.</p>
    </x-slot>

    <div class="bg-white p-10 rounded-2xl shadow-xl mb-10">
        <div class="flex items-center mb-8">
            <div class="flex-shrink-0 bg-blue-100 rounded-full p-4">
                @if($doctor->profile_photo)
                    <img src="{{ $doctor->profile_photo }}" alt="Photo" class="w-16 h-16 rounded-full object-cover">
                @else
                    <span class="inline-block w-16 h-16 rounded-full bg-blue-200 flex items-center justify-center text-blue-500 font-bold text-2xl">{{ strtoupper(substr($doctor->name,0,1)) }}</span>
                @endif
            </div>
            <div class="ml-6">
                <h2 class="text-2xl font-bold text-blue-900">{{ $doctor->name }}</h2>
                <div class="text-gray-500">{{ $doctor->email }}</div>
                <div class="text-gray-500">{{ $doctor->phone }}</div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div><span class="font-semibold">Gender:</span> {{ ucfirst($doctor->gender) }}</div>
            <div><span class="font-semibold">Qualification:</span> {{ $doctor->qualification }}</div>
            <div><span class="font-semibold">Specialization:</span> {{ $doctor->specialization }}</div>
            <div><span class="font-semibold">Department:</span> {{ $doctor->department }}</div>
            <div><span class="font-semibold">Experience:</span> {{ $doctor->experience }} years</div>
            <div><span class="font-semibold">Date of Joining:</span> {{ $doctor->date_of_joining }}</div>
            <div><span class="font-semibold">Room Number:</span> {{ $doctor->room_number ?? '-' }}</div>
            <div><span class="font-semibold">Timing:</span> {{ $doctor->timing ?? '-' }}</div>
            <div><span class="font-semibold">Available:</span>
                @if($doctor->is_available)
                    <span class="inline-block px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Available</span>
                @else
                    <span class="inline-block px-2 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">Not Available</span>
                @endif
            </div>
            <div><span class="font-semibold">Consultation Fee:</span> ₹{{ $doctor->consultation_fee ?? '-' }}</div>
            <div><span class="font-semibold">License Number:</span> {{ $doctor->license_number ?? '-' }}</div>
            <div><span class="font-semibold">Address:</span> {{ $doctor->address ?? '-' }}</div>
        </div>
        <div class="mb-4">
            <span class="font-semibold">Bio:</span>
            <div class="text-gray-700 mt-1">{{ $doctor->bio ?? '-' }}</div>
        </div>
        <a href="{{ route('doctors.index') }}" class="inline-block mt-4 text-blue-600 hover:underline font-semibold">← Back to List</a>
    </div>
</x-app-layout>
