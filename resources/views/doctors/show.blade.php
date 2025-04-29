<x-app-layout>
    <x-slot name="header"> 
        <h1 class="text-2xl font-bold mb-4">Doctor Details</h1>
    </x-slot>

    <div class="bg-white p-6 rounded shadow-md">
        <p><strong>Name:</strong> {{ $doctor->name }}</p>
        <p><strong>Email:</strong> {{ $doctor->email }}</p>
        <p><strong>Specialization:</strong> {{ $doctor->specialization }}</p>
        <p><strong>Phone:</strong> {{ $doctor->phone }}</p>
        <p><strong>Experience:</strong> {{ $doctor->experience }} years</p>
    </div>
    <a href="{{ route('doctors.index') }}" class="inline-block mt-4 text-blue-500">Back to List</a>
</x-app-layout>
