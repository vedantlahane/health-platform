<x-app-layout>
    <x-slot name="header"> 
        <h1 class="text-2xl font-bold mb-4">Edit Doctor</h1>
    </x-slot>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('doctors.update', $doctor) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" value="{{ $doctor->name }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" value="{{ $doctor->email }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Specialization</label>
            <input type="text" name="specialization" value="{{ $doctor->specialization }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Phone Number</label>
            <input type="text" name="phone" value="{{ $doctor->phone }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Experience (Years)</label>
            <input type="number" name="experience" value="{{ $doctor->experience }}" class="border p-2 w-full" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</x-app-layout>
