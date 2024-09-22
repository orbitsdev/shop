<div class="container mx-auto my-10">
    <!-- Success Message -->
    <div class="bg-[#fafafa] text-green-700  p-4 rounded-lg mb-6 flex items-center space-x-3">
        <!-- Success Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-white">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m-7 8a9 9 0 1118 0a9 9 0 01-18 0z" />
        </svg>
    
        <!-- Success Message Text -->
        <div>
            <h2 class="text-2xl font-bold">Thank you! Your order has been placed successfully.</h2>
            <p class="mt-2">Order #{{ $order->id }}</p>
        </div>
    </div>
    

    <!-- Order Summary Details -->
    <div class="bg-white p-6  rounded-lg">
        <h3 class="text-2xl font-bold mb-4">Order Summary</h3>

        <!-- Order Items Table -->
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-cerise-red-50">
                    <th class="px-4 py-2 text-left">Product</th>
                    <th class="px-4 py-2 text-center">Quantity</th>
                    <th class="px-4 py-2 text-right">Price</th>
                    <th class="px-4 py-2 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                <tr>
                    <td class="border px-4 py-4">
                        <!-- Align product name and image together -->
                        <div class="flex items-center">
                            <img src="{{$item->product->getImage()}}" alt="{{ $item->product->name }}" class="w-12 h-12 rounded-lg mr-4">
                            <div>
                                <p class="font-bold">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-500">SKU: {{ $item->product->sku ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="border px-4 py-4 text-center">{{ $item->quantity }}</td>
                    <td class="border px-4 py-4 text-right">Php {{ number_format($item->price, 2) }}</td>
                    <td class="border px-4 py-4 text-right">Php {{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="mt-4 flex justify-between items-center">
            <h3 class="text-xl font-bold">Total Amount</h3>
            <p class="text-xl font-bold">Php {{ number_format($order->total_price, 2) }}</p>
        </div>
    </div>

    <!-- Back to Shopping Button -->
    <div class="mt-6">
        <a href="{{ route('product.index') }}" class="bg-cerise-red-500 hover:bg-cerise-red-600 text-white py-3 px-6 rounded-lg text-lg">
            Continue Shopping
        </a>
    </div>
</div>
