<div class="container mx-auto my-10">
    <h2 class="text-3xl font-bold mb-6">Order #{{ $order->id }} Details</h2>

    <!-- Order Status and Dates -->
    <div class="flex justify-between items-center bg-gray-100 p-4 rounded-lg mb-6">
        <div>
            <p class="text-sm text-gray-500">Order Placed: {{ $order->created_at->format('M d, Y') }}</p>
            <p class="text-sm text-gray-500">Estimated Delivery: {{ $order->delivery_date ?? 'TBD' }}</p>
        </div>
        <span class="px-3 py-1 bg-green-500 text-white text-sm rounded-full">{{ ucfirst($order->status) }}</span>
    </div>

    <!-- Order Items -->
    <div class="bg-white p-6  border border-gray-100 rounded-lg mb-6">
        <h3 class="text-2xl font-bold mb-4">Items in this Order</h3>

        @foreach ($order->orderItems as $item)
        <div class="flex items-center border-b py-4">
            <!-- Product Image -->
            <img src="{{$item->product->getImage()}}" alt="{{ $item->product->name }}" class="w-16 h-16 rounded-lg mr-4">

            <!-- Product Details -->
            <div class="flex-1">
                <p class="font-bold">{{ $item->product->name }}</p>
                <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                <p class="text-sm text-gray-500">Price: {{ number_format($item->price, 2) }}</p>
            </div>

            <!-- Total for each product -->
            <div class="text-right">
                <p class="font-semibold">Php{{ number_format($item->quantity * $item->price, 2) }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Shipping Information -->
    {{-- <div class="bg-white p-6  border border-gray-100 rounded-lg mb-6">
        <h3 class="text-2xl font-bold mb-4">Shipping Information</h3>
        <p class="text-sm"><strong>Address:</strong> {{ $order->shipping_address }}</p>
        <p class="text-sm"><strong>Contact:</strong> {{ $order->user->name }}, {{ $order->user->email }}</p>
    </div> --}}

    <!-- Order Total -->
    <div class="bg-white p-6  border border-gray-100 rounded-lg">
        <div class="flex justify-between items-center">
            <p class="text-2xl font-bold">Total Amount</p>
            <p class="text-2xl font-bold">Php {{ number_format($order->total_price, 2) }}</p>
        </div>
    </div>

    <!-- Back to Orders Button -->
    <div class="mt-6">
        <a href="{{ route('orders.list') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-3 px-6 rounded-lg text-lg">
            Back to Orders
        </a>
    </div>
</div>
