<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold mb-4">Edit Appointment</h1>
    </x-slot>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.update', $appointment) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="patient_id" class="block text-gray-700 font-bold mb-2">Patient</label>
            <select name="patient_id" id="patient_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select Patient</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" @if($appointment->patient_id == $patient->id) selected @endif>{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="doctor_id" class="block text-gray-700 font-bold mb-2">Doctor</label>
            <select name="doctor_id" id="doctor_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select Doctor</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" @if($appointment->doctor_id == $doctor->id) selected @endif>{{ $doctor->name }} ({{ $doctor->specialization }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="appointment_time" class="block text-gray-700 font-bold mb-2">Appointment Date & Time</label>
            <input type="datetime-local" name="appointment_time" id="appointment_time" value="{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('Y-m-d\TH:i') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="scheduled" @if($appointment->status == 'scheduled') selected @endif>Scheduled</option>
                <option value="completed" @if($appointment->status == 'completed') selected @endif>Completed</option>
                <option value="cancelled" @if($appointment->status == 'cancelled') selected @endif>Cancelled</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="notes" class="block text-gray-700 font-bold mb-2">Notes</label>
            <textarea name="notes" id="notes" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $appointment->notes }}</textarea>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Appointment
            </button>
            <a href="{{ route('appointments.index') }}" class="text-blue-500 hover:underline">Cancel</a>
        </div>
    </form>
</x-app-layout>
