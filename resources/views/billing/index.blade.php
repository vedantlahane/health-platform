<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Billing & Invoices</h1>
            <a href="{{ route('billing.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow transition">
                + Create New Invoice
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-xl shadow-lg border border-gray-200">
            <thead class="bg-blue-50 border-b border-blue-100 text-blue-800">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold">Invoice #</th>
                    <th class="py-3 px-4 text-left font-semibold">Patient</th>
                    <th class="py-3 px-4 text-left font-semibold">Status</th>
                    <th class="py-3 px-4 text-left font-semibold">Total</th>
                    <th class="py-3 px-4 text-left font-semibold">Payment Method</th>
                    <th class="py-3 px-4 text-left font-semibold">Paid/Due Date</th>
                    <th class="py-3 px-4 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($billings as $billing)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="py-2 px-4 border-b">{{ $billing->invoice_number }}</td>
                        <td class="py-2 px-4 border-b">{{ $billing->patient->name }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="px-2 py-1 rounded text-xs 
                                @if($billing->status == 'paid') bg-green-100 text-green-800
                                @elseif($billing->status == 'unpaid') bg-red-100 text-red-800
                                @elseif($billing->status == 'partial') bg-yellow-100 text-yellow-800
                                @endif">
                                {{ ucfirst($billing->status) }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b font-bold text-blue-700">${{ number_format($billing->total, 2) }}</td>
                        <td class="py-2 px-4 border-b">{{ $billing->payment_method ?? 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">
                            @if($billing->status == 'paid' && $billing->paid_at)
                                <span class="text-green-700">
                                    Paid: {{ optional($billing->paid_at)->format('M d, Y') ?? '-' }}
                                </span>
                            @elseif($billing->due_date)
                                <span class="text-red-700">
                                    Due: {{ optional($billing->due_date)->format('M d, Y') ?? '-' }}
                                </span>
                            @else
                                <span class="text-gray-500">N/A</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('billing.show', $billing) }}" class="text-blue-500 hover:underline mr-2">View</a>
                            <a href="{{ route('billing.edit', $billing) }}" class="text-yellow-500 hover:underline mr-2">Edit</a>
                            <form action="{{ route('billing.destroy', $billing) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this invoice?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 px-4 text-center text-gray-500">No invoices found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
