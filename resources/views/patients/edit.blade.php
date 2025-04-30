<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Edit Patient</h1>
        <p class="text-gray-600">Update patient details and medical information.</p>
    </x-slot>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('patients.update', $patient) }}" method="POST" class="bg-white p-10 rounded-2xl shadow-xl mb-10">
        @csrf
        @method('PUT')

        <!-- Personal Information -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0113 0"/></svg>
                Personal Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="font-semibold">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $patient->name) }}" class="border p-2 w-full rounded" required>
                </div>
                <div>
                    <label class="font-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email', $patient->email) }}" class="border p-2 w-full rounded" required>
                </div>
                <div>
                    <label class="font-semibold">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $patient->phone) }}" class="border p-2 w-full rounded" required>
                </div>
                <div>
                    <label class="font-semibold">Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob', $patient->dob) }}" class="border p-2 w-full rounded" required>
                </div>
                <div>
                    <label class="font-semibold">Gender</label>
                    <select name="gender" class="border p-2 w-full rounded" required>
                        <option value="">Select Gender</option>
                        <option value="male" @if(old('gender', $patient->gender) == 'male') selected @endif>Male</option>
                        <option value="female" @if(old('gender', $patient->gender) == 'female') selected @endif>Female</option>
                        <option value="other" @if(old('gender', $patient->gender) == 'other') selected @endif>Other</option>
                    </select>
                </div>
                <div>
                    <label class="font-semibold">Blood Group</label>
                    <input type="text" name="blood_group" value="{{ old('blood_group', $patient->blood_group) }}" class="border p-2 w-full rounded" placeholder="e.g. A+, O-">
                </div>
            </div>
        </div>

        <!-- Contact & Insurance -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4.5 8-10V5a2 2 0 00-2-2H6a2 2 0 00-2 2v7c0 5.5 8 10 8 10z"/></svg>
                Contact & Insurance
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label class="font-semibold">Address</label>
                    <input type="text" name="address" value="{{ old('address', $patient->address) }}" class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="font-semibold">Emergency Contact</label>
                    <input type="text" name="emergency_contact" value="{{ old('emergency_contact', $patient->emergency_contact) }}" class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="font-semibold">Insurance</label>
                    <input type="text" name="insurance" value="{{ old('insurance', $patient->insurance) }}" class="border p-2 w-full rounded">
                </div>
            </div>
        </div>

        <!-- Medical Information -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-blue-700 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2z"/></svg>
                Medical Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="font-semibold">Allergies</label>
                    <input type="text" name="allergies" value="{{ old('allergies', $patient->allergies) }}" class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="font-semibold">Medications</label>
                    <input type="text" name="medications" value="{{ old('medications', $patient->medications) }}" class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="font-semibold">Family History</label>
                    <input type="text" name="family_history" value="{{ old('family_history', $patient->family_history) }}" class="border p-2 w-full rounded">
                </div>
                <div>
                    <label class="font-semibold">Social History</label>
                    <input type="text" name="social_history" value="{{ old('social_history', $patient->social_history) }}" class="border p-2 w-full rounded">
                </div>
            </div>
            <div class="mt-6">
                <label class="font-semibold">Medical History / Notes</label>
                <textarea name="medical_history" class="border p-2 w-full rounded" rows="3">{{ old('medical_history', $patient->medical_history) }}</textarea>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold shadow transition">
                Update Patient
            </button>
        </div>
    </form>
</x-app-layout>
