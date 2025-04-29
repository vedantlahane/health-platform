<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-4">Add Patient</h1>
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

    <form action="{{ route('patients.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Gender</label>
            <select name="gender" class="border p-2 w-full" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Medical History</label>
            <textarea name="medical_history" class="border p-2 w-full"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</x-app-layout>
