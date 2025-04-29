<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                <div class="bg-blue-100 p-6 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold text-blue-800">{{ \App\Models\Patient::count() }}</div>
                    <div class="text-blue-700">Patients</div>
                </div>
                <div class="bg-green-100 p-6 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold text-green-800">{{ \App\Models\Doctor::count() }}</div>
                    <div class="text-green-700">Doctors</div>
                </div>
                <div class="bg-yellow-100 p-6 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold text-yellow-800">{{ \App\Models\Appointment::whereDate('appointment_time', today())->count() }}</div>
                    <div class="text-yellow-700">Today's Appointments</div>
                </div>
                <div class="bg-pink-100 p-6 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold text-pink-800">{{ \App\Models\Billing::count() }}</div>
                    <div class="text-pink-700">Invoices</div>
                </div>
                <div class="bg-purple-100 p-6 rounded-lg shadow text-center">
                    <div class="text-2xl font-bold text-purple-800">{{ \App\Models\DeviceData::count() }}</div>
                    <div class="text-purple-700">Device Data</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-100">Quick Actions</h3>
                <div class="flex flex-wrap gap-4 mb-4">
                    <a href="{{ route('patients.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">Add Patient</a>
                    <a href="{{ route('doctors.create') }}" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600">Add Doctor</a>
                    <a href="{{ route('appointments.create') }}" class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600">Schedule Appointment</a>
                    <a href="{{ route('device-data.create') }}" class="bg-purple-500 text-white px-4 py-2 rounded shadow hover:bg-purple-600">Record Device Data</a>
                    <a href="{{ route('billing.create') }}" class="bg-pink-500 text-white px-4 py-2 rounded shadow hover:bg-pink-600">Create Invoice</a>
                </div>
                <div class="mt-6 flex flex-wrap gap-4">
                    <a href="{{ route('patients.index') }}" class="bg-blue-100 text-blue-800 px-4 py-2 rounded shadow hover:bg-blue-200">Manage Patients</a>
                    <a href="{{ route('doctors.index') }}" class="bg-green-100 text-green-800 px-4 py-2 rounded shadow hover:bg-green-200">Manage Doctors</a>
                    <a href="{{ route('appointments.index') }}" class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded shadow hover:bg-yellow-200">Manage Appointments</a>
                    <a href="{{ route('device-data.index') }}" class="bg-purple-100 text-purple-800 px-4 py-2 rounded shadow hover:bg-purple-200">Manage Device Data</a>
                    <a href="{{ route('billing.index') }}" class="bg-pink-100 text-pink-800 px-4 py-2 rounded shadow hover:bg-pink-200">Manage Billing</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
