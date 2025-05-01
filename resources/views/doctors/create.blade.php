<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-2">{{ isset($doctor) ? 'Edit Doctor' : 'Add Doctor' }}</h1>
        <p class="text-gray-600">{{ isset($doctor) ? 'Update doctor details.' : 'Register a new doctor.' }}</p>
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

    <form action="{{ isset($doctor) ? route('doctors.update', $doctor) : route('doctors.store') }}" method="POST" class="bg-white p-10 rounded-2xl shadow-xl mb-10">
        @csrf
        @if(isset($doctor))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="font-semibold">Name</label>
                <input type="text" name="name" value="{{ old('name', $doctor->name ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $doctor->email ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $doctor->phone ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Gender</label>
                <select name="gender" class="border p-2 w-full rounded">
                    <option value="">Select Gender</option>
                    <option value="male" @selected(old('gender', $doctor->gender ?? '') == 'male')>Male</option>
                    <option value="female" @selected(old('gender', $doctor->gender ?? '') == 'female')>Female</option>
                    <option value="other" @selected(old('gender', $doctor->gender ?? '') == 'other')>Other</option>
                </select>
            </div>
            <div>
                <label class="font-semibold">Qualification</label>
                <input type="text" name="qualification" value="{{ old('qualification', $doctor->qualification ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Specialization</label>
                <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Department</label>
                <input type="text" name="department" value="{{ old('department', $doctor->department ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Profile Photo URL</label>
                <input type="text" name="profile_photo" value="{{ old('profile_photo', $doctor->profile_photo ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Address</label>
                <input type="text" name="address" value="{{ old('address', $doctor->address ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Date of Joining</label>
                <input type="date" name="date_of_joining" value="{{ old('date_of_joining', $doctor->date_of_joining ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Experience (Years)</label>
                <input type="number" name="experience" value="{{ old('experience', $doctor->experience ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Room Number</label>
                <input type="text" name="room_number" value="{{ old('room_number', $doctor->room_number ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Timing</label>
                <input type="text" name="timing" value="{{ old('timing', $doctor->timing ?? '') }}" class="border p-2 w-full rounded" placeholder="e.g. 9am - 5pm">
            </div>
            <div>
                <label class="font-semibold">Available</label>
                <select name="is_available" class="border p-2 w-full rounded">
                    <option value="1" @selected(old('is_available', $doctor->is_available ?? 1) == 1)>Yes</option>
                    <option value="0" @selected(old('is_available', $doctor->is_available ?? 1) == 0)>No</option>
                </select>
            </div>
            <div>
                <label class="font-semibold">Consultation Fee</label>
                <input type="number" step="0.01" name="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">License Number</label>
                <input type="text" name="license_number" value="{{ old('license_number', $doctor->license_number ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div class="md:col-span-2">
                <label class="font-semibold">Bio</label>
                <textarea name="bio" class="border p-2 w-full rounded">{{ old('bio', $doctor->bio ?? '') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold shadow transition">
                {{ isset($doctor) ? 'Update Doctor' : 'Save Doctor' }}
            </button>
        </div>
    </form>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-2">{{ isset($doctor) ? 'Edit Doctor' : 'Add Doctor' }}</h1>
        <p class="text-gray-600">{{ isset($doctor) ? 'Update doctor details.' : 'Register a new doctor.' }}</p>
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

    <form action="{{ isset($doctor) ? route('doctors.update', $doctor) : route('doctors.store') }}" method="POST" class="bg-white p-10 rounded-2xl shadow-xl mb-10">
        @csrf
        @if(isset($doctor))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="font-semibold">Name</label>
                <input type="text" name="name" value="{{ old('name', $doctor->name ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $doctor->email ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $doctor->phone ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Gender</label>
                <select name="gender" class="border p-2 w-full rounded">
                    <option value="">Select Gender</option>
                    <option value="male" @selected(old('gender', $doctor->gender ?? '') == 'male')>Male</option>
                    <option value="female" @selected(old('gender', $doctor->gender ?? '') == 'female')>Female</option>
                    <option value="other" @selected(old('gender', $doctor->gender ?? '') == 'other')>Other</option>
                </select>
            </div>
            <div>
                <label class="font-semibold">Qualification</label>
                <input type="text" name="qualification" value="{{ old('qualification', $doctor->qualification ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Specialization</label>
                <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Department</label>
                <input type="text" name="department" value="{{ old('department', $doctor->department ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Profile Photo URL</label>
                <input type="text" name="profile_photo" value="{{ old('profile_photo', $doctor->profile_photo ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Address</label>
                <input type="text" name="address" value="{{ old('address', $doctor->address ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Date of Joining</label>
                <input type="date" name="date_of_joining" value="{{ old('date_of_joining', $doctor->date_of_joining ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Experience (Years)</label>
                <input type="number" name="experience" value="{{ old('experience', $doctor->experience ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="font-semibold">Room Number</label>
                <input type="text" name="room_number" value="{{ old('room_number', $doctor->room_number ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">Timing</label>
                <input type="text" name="timing" value="{{ old('timing', $doctor->timing ?? '') }}" class="border p-2 w-full rounded" placeholder="e.g. 9am - 5pm">
            </div>
            <div>
                <label class="font-semibold">Available</label>
                <select name="is_available" class="border p-2 w-full rounded">
                    <option value="1" @selected(old('is_available', $doctor->is_available ?? 1) == 1)>Yes</option>
                    <option value="0" @selected(old('is_available', $doctor->is_available ?? 1) == 0)>No</option>
                </select>
            </div>
            <div>
                <label class="font-semibold">Consultation Fee</label>
                <input type="number" step="0.01" name="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label class="font-semibold">License Number</label>
                <input type="text" name="license_number" value="{{ old('license_number', $doctor->license_number ?? '') }}" class="border p-2 w-full rounded">
            </div>
            <div class="md:col-span-2">
                <label class="font-semibold">Bio</label>
                <textarea name="bio" class="border p-2 w-full rounded">{{ old('bio', $doctor->bio ?? '') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold shadow transition">
                {{ isset($doctor) ? 'Update Doctor' : 'Save Doctor' }}
            </button>
        </div>
    </form>
</x-app-layout>
