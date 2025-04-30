<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Patient Details</h1>
        <p class="text-gray-600">Complete profile and medical summary</p>
    </x-slot>

    <div class="bg-white p-10 rounded-2xl shadow-xl mb-10">
        <div class="flex items-center mb-8">
            <div class="flex-shrink-0 bg-blue-100 rounded-full p-4">
                <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M5.5 21a7.5 7.5 0 0113 0"/>
                </svg>
            </div>
            <div class="ml-6">
                <h2 class="text-2xl font-bold text-blue-900">{{ $patient->name }}</h2>
                <div class="text-gray-500">{{ $patient->email }}</div>
                <div class="text-gray-500">{{ $patient->phone }}</div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <span class="font-semibold">DOB:</span> {{ $patient->dob }}
            </div>
            <div>
                <span class="font-semibold">Gender:</span> {{ ucfirst($patient->gender) }}
            </div>
            <div>
                <span class="font-semibold">Blood Group:</span> {{ $patient->blood_group ?? '-' }}
            </div>
            <div>
                <span class="font-semibold">Address:</span> {{ $patient->address ?? '-' }}
            </div>
            <div>
                <span class="font-semibold">Allergies:</span> {{ $patient->allergies ?? '-' }}
            </div>
            <div>
                <span class="font-semibold">Medications:</span> {{ $patient->medications ?? '-' }}
            </div>
            <div>
                <span class="font-semibold">Family History:</span> {{ $patient->family_history ?? '-' }}
            </div>
            <div>
                <span class="font-semibold">Social History:</span> {{ $patient->social_history ?? '-' }}
            </div>
            <div>
                <span class="font-semibold">Emergency Contact:</span> {{ $patient->emergency_contact ?? '-' }}
            </div>
            <div>
                <span class="font-semibold">Insurance:</span> {{ $patient->insurance ?? '-' }}
            </div>
        </div>
        <div class="mb-4">
            <span class="font-semibold">Medical History / Notes:</span>
            <div class="text-gray-700 mt-1">{{ $patient->medical_history ?? '-' }}</div>
        </div>
        <a href="{{ route('patients.index') }}" class="inline-block mt-4 text-blue-600 hover:underline font-semibold">← Back to List</a>
    </div>
</x-app-layout>
