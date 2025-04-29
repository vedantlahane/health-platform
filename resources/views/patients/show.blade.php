<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-4">Patient Details</h1>
    </x-slot>

    <div class="bg-white p-6 rounded shadow-md">
        <p><strong>Name:</strong> {{ $patient->name }}</p>
        <p><strong>Email:</strong> {{ $patient->email }}</p>
        <p><strong>Date of Birth:</strong> {{ $patient->dob }}</p>
        <p><strong>Gender:</strong> {{ $patient->gender }}</p>
        <p><strong>Medical History:</strong> {{ $patient->medical_history }}</p>
    </div>
    <a href="{{ route('patients.index') }}" class="inline-block mt-4 text-blue-500">Back to List</a>
</x-app-layout>
