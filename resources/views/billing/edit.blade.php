<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-blue-800 mb-4">Edit Invoice</h1>
        <p class="text-gray-600">Update invoice details and items.</p>
    </x-slot>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('billing.update', $billing) }}" method="POST" id="billing-form" class="bg-white p-10 rounded-2xl shadow-xl mb-10 mx-auto space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="font-semibold">Patient</label>
                <select name="patient_id" class="border p-2 w-full rounded" required>
                    <option value="">Select Patient</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ old('patient_id', $billing->patient_id) == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Invoice Number</label>
                <input type="text" name="invoice_number" class="border p-2 w-full rounded" value="{{ old('invoice_number', $billing->invoice_number) }}" required>
            </div>
        </div>

        <div class="mb-8">
            <label class="font-semibold mb-2 block">Items/Services</label>
            <table class="w-full mb-4" id="items-table">
                <thead>
                    <tr class="bg-blue-50">
                        <th class="p-2">Name</th>
                        <th class="p-2">Qty</th>
                        <th class="p-2">Unit Price</th>
                        <th class="p-2">Total</th>
                        <th class="p-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(old('items'))
                        @foreach(json_decode(old('items'), true) as $item)
                            <tr>
                                <td><input type="text" class="border p-2 rounded item-name" value="{{ $item['name'] }}" required></td>
                                <td><input type="number" class="border p-2 rounded item-qty" value="{{ $item['quantity'] }}" min="1" required></td>
                                <td><input type="number" class="border p-2 rounded item-price" value="{{ $item['unit_price'] }}" min="0" step="0.01" required></td>
                                <td class="item-total font-semibold text-blue-700"></td>
                                <td><button type="button" onclick="this.closest('tr').remove(); updateTotals();" class="text-red-600">Remove</button></td>
                            </tr>
                        @endforeach
                    @else
                        @foreach($billing->items as $item)
                            <tr>
                                <td><input type="text" class="border p-2 rounded item-name" value="{{ $item['name'] }}" required></td>
                                <td><input type="number" class="border p-2 rounded item-qty" value="{{ $item['quantity'] }}" min="1" required></td>
                                <td><input type="number" class="border p-2 rounded item-price" value="{{ $item['unit_price'] }}" min="0" step="0.01" required></td>
                                <td class="item-total font-semibold text-blue-700"></td>
                                <td><button type="button" onclick="this.closest('tr').remove(); updateTotals();" class="text-red-600">Remove</button></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <button type="button" onclick="addItemRow()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-1 rounded">+ Add Item</button>
            <input type="hidden" name="items" id="items-json" value="{{ old('items', json_encode($billing->items)) }}">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="font-semibold">Subtotal</label>
                <input type="text" id="subtotal" class="border p-2 w-full rounded bg-gray-100" readonly>
            </div>
            <div>
                <label class="font-semibold">Tax</label>
                <input type="number" step="0.01" name="tax" id="tax" class="border p-2 w-full rounded" value="{{ old('tax', $billing->tax) }}">
            </div>
            <div>
                <label class="font-semibold">Discount</label>
                <input type="number" step="0.01" name="discount" id="discount" class="border p-2 w-full rounded" value="{{ old('discount', $billing->discount) }}">
            </div>
            <div>
                <label class="font-semibold">Total</label>
                <input type="text" id="total" class="border p-2 w-full rounded bg-gray-100 font-bold" readonly>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="font-semibold">Status</label>
                <select name="status" class="border p-2 w-full rounded" required>
                    <option value="unpaid" {{ old('status', $billing->status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="paid" {{ old('status', $billing->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="partial" {{ old('status', $billing->status) == 'partial' ? 'selected' : '' }}>Partially Paid</option>
                </select>
            </div>
            <div>
                <label class="font-semibold">Payment Method</label>
                <input type="text" name="payment_method" class="border p-2 w-full rounded" value="{{ old('payment_method', $billing->payment_method) }}" placeholder="e.g. Cash, Card, UPI">
            </div>
            <div>
                <label class="font-semibold">Paid Date</label>
                <input type="date" name="paid_at" class="border p-2 w-full rounded"
    value="{{ old('paid_at', optional($billing->paid_at)->format('Y-m-d')) }}">

            <div>
                <label class="font-semibold">Due Date</label>
                <input type="date" name="due_date" class="border p-2 w-full rounded"
    value="{{ old('due_date', $billing->due_date?->format('Y-m-d')) }}" required>

            </div>
        </div>

        <div>
            <label class="font-semibold">Description</label>
            <textarea name="description" rows="3" class="border p-2 w-full rounded" placeholder="Any additional notes...">{{ old('description', $billing->description) }}</textarea>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('billing.index') }}" class="bg-gray-100 hover:bg-gray-200 text-blue-600 px-6 py-2 rounded-lg font-semibold shadow transition">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg font-bold shadow transition">
                Update Invoice
            </button>
        </div>
    </form>

    <script>
        function addItemRow(name = '', qty = 1, price = 0) {
            const tbody = document.querySelector('#items-table tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input type="text" class="border p-2 rounded item-name" value="${name}" required></td>
                <td><input type="number" class="border p-2 rounded item-qty" value="${qty}" min="1" required></td>
                <td><input type="number" class="border p-2 rounded item-price" value="${price}" min="0" step="0.01" required></td>
                <td class="item-total font-semibold text-blue-700"></td>
                <td><button type="button" onclick="this.closest('tr').remove(); updateTotals();" class="text-red-600">Remove</button></td>
            `;
            tbody.appendChild(row);
            updateTotals();
        }

        function updateTotals() {
            let subtotal = 0;
            let items = [];
            document.querySelectorAll('#items-table tbody tr').forEach(row => {
                const name = row.querySelector('.item-name').value;
                const qty = parseInt(row.querySelector('.item-qty').value) || 0;
                const price = parseFloat(row.querySelector('.item-price').value) || 0;
                const total = qty * price;
                row.querySelector('.item-total').textContent = total.toFixed(2);
                if (name && qty && price) {
                    items.push({ name, quantity: qty, unit_price: price });
                    subtotal += total;
                }
            });
            document.getElementById('subtotal').value = subtotal.toFixed(2);

            const tax = parseFloat(document.getElementById('tax').value) || 0;
            const discount = parseFloat(document.getElementById('discount').value) || 0;
            const total = subtotal + tax - discount;
            document.getElementById('total').value = total.toFixed(2);

            document.getElementById('items-json').value = JSON.stringify(items);
        }

        document.getElementById('billing-form').addEventListener('input', updateTotals);

        window.onload = function() {
            // If there are no items, add a blank row
            const tbody = document.querySelector('#items-table tbody');
            if (!tbody.children.length) {
                addItemRow();
            } else {
                updateTotals();
            }
        };
    </script>
</x-app-layout>
