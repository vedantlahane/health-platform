<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-blue-800 mb-2">Invoice Details</h1>
            <div class="flex gap-2">
                <a href="{{ route('billing.edit', $billing) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-semibold shadow transition">
                    Edit Invoice
                </a>
                <a href="{{ route('billing.index') }}" class="bg-gray-100 hover:bg-gray-200 text-blue-600 px-4 py-2 rounded-lg font-semibold shadow transition">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white p-8 rounded-2xl shadow-xl mb-10">
        <div class="flex justify-between items-start mb-8 pb-6 border-b">
            <div>
                <h2 class="text-2xl font-bold text-blue-800">Invoice #{{ $billing->invoice_number }}</h2>
                <div class="text-gray-600 mt-1">
                    <p>Created: {{ $billing->created_at ? $billing->created_at->format('M d, Y') : '-' }}</p>
                    @if($billing->status == 'paid' && $billing->paid_at)
                        <p>Paid on: {{ optional($billing->paid_at)->format('M d, Y') ?? '-' }}</p>
                    @elseif($billing->due_date)
                        <p>Due on: {{ optional($billing->due_date)->format('M d, Y') ?? '-' }}</p>
                    @else
                        <p>Due on: <span class="text-gray-400">N/A</span></p>
                    @endif
                </div>
            </div>
            <div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    @if($billing->status == 'paid') bg-green-100 text-green-800
                    @elseif($billing->status == 'unpaid') bg-red-100 text-red-800
                    @elseif($billing->status == 'partial') bg-yellow-100 text-yellow-800
                    @endif">
                    {{ ucfirst($billing->status) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Patient Information</h3>
                <div class="bg-gray-50 p-4 rounded">
                    <p class="font-bold">{{ $billing->patient->name }}</p>
                    <p>{{ $billing->patient->email }}</p>
                    <p>{{ $billing->patient->phone }}</p>
                    <p>{{ $billing->patient->address }}</p>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Payment Details</h3>
                <div class="bg-gray-50 p-4 rounded">
                    <p><span class="font-semibold">Method:</span> {{ $billing->payment_method ?? 'Not specified' }}</p>
                    <p><span class="font-semibold">Status:</span> {{ ucfirst($billing->status) }}</p>
                    @if($billing->status == 'paid' && $billing->paid_at)
                        <p><span class="font-semibold">Paid on:</span> {{ optional($billing->paid_at)->format('M d, Y') ?? '-' }}</p>
                    @elseif($billing->due_date)
                        <p><span class="font-semibold">Due on:</span> {{ optional($billing->due_date)->format('M d, Y') ?? '-' }}</p>
                    @else
                        <p><span class="font-semibold">Due on:</span> <span class="text-gray-400">N/A</span></p>
                    @endif
                </div>
            </div>
        </div>

        <h3 class="text-lg font-semibold text-gray-700 mb-2">Invoice Items</h3>
        <div class="overflow-x-auto mb-8">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Item</th>
                        <th class="py-2 px-4 border-b text-right">Quantity</th>
                        <th class="py-2 px-4 border-b text-right">Unit Price</th>
                        <th class="py-2 px-4 border-b text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($billing->items as $item)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $item['name'] }}</td>
                            <td class="py-2 px-4 border-b text-right">{{ $item['quantity'] }}</td>
                            <td class="py-2 px-4 border-b text-right">${{ number_format($item['unit_price'], 2) }}</td>
                            <td class="py-2 px-4 border-b text-right">${{ number_format($item['quantity'] * $item['unit_price'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="py-2 px-4 text-right font-semibold">Subtotal:</td>
                        <td class="py-2 px-4 text-right">${{ number_format($billing->subtotal, 2) }}</td>
                    </tr>
                    @if($billing->tax > 0)
                    <tr>
                        <td colspan="3" class="py-2 px-4 text-right font-semibold">Tax:</td>
                        <td class="py-2 px-4 text-right">${{ number_format($billing->tax, 2) }}</td>
                    </tr>
                    @endif
                    @if($billing->discount > 0)
                    <tr>
                        <td colspan="3" class="py-2 px-4 text-right font-semibold">Discount:</td>
                        <td class="py-2 px-4 text-right">-${{ number_format($billing->discount, 2) }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="3" class="py-2 px-4 text-right font-bold text-lg">Total:</td>
                        <td class="py-2 px-4 text-right font-bold text-lg text-blue-700">${{ number_format($billing->total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if($billing->description)
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Notes</h3>
            <div class="bg-gray-50 p-4 rounded">
                {{ $billing->description }}
            </div>
        </div>
        @endif

        <div class="flex justify-between items-center mt-10 pt-6 border-t">
            <div class="text-gray-500">
                <p>Thank you for your business!</p>
            </div>
            <div>
                <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold shadow transition">
                    Print Invoice
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
