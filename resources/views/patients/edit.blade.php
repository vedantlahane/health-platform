<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-4">Edit Patient</h1>
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

    <form action="{{ route('patients.update', $patient) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" value="{{ $patient->name }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" value="{{ $patient->email }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Date of Birth</label>
            <input type="date" name="dob" value="{{ $patient->dob }}" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label>Gender</label>
            <select name="gender" class="border p-2 w-full" required>
                <option value="male" @if($patient->gender == 'male') selected @endif>Male</option>
                <option value="female" @if($patient->gender == 'female') selected @endif>Female</option>
                <option value="other" @if($patient->gender == 'other') selected @endif>Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label>Medical History</label>
            <textarea name="medical_history" class="border p-2 w-full">{{ $patient->medical_history }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</x-app-layout>
