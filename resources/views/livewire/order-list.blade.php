<div class="container mx-auto my-10">
    <h2 class="text-3xl font-bold mb-6">Your Orders</h2>

    @forelse($orders as $order)
    <div class="bg-white p-6  rounded-lg mb-6">
        <!-- Order Header -->
        <div class="flex justify-between items-center mb-4">
            <div>
                <p class="text-sm text-gray-500">Order #{{ $order->id }}</p>
                <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('M d, Y') }}</p>
            </div>
            <div>
                <span class="px-3 py-1 bg-green-500 text-white text-sm rounded-full">{{ ucfirst($order->status) }}</span>
            </div>
        </div>

        <!-- Order Items -->
        <div>
            @foreach ($order->orderItems as $item)
            <div class="flex items-center border-b py-4">
                <!-- Product Image -->
                <img src="{{$item->product->getImage()}}" alt="{{ $item->product->name }}" class="w-16 h-16 rounded-lg mr-4">

                <!-- Product Details -->
                <div class="flex-1">
                    <p class="font-bold">{{ $item->product->name }}</p>
                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                </div>

                <!-- Price -->
                <div class="text-right">
                    <p class="font-semibold">Php {{ number_format($item->price * $item->quantity, 2) }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Order Total & Details Button -->
        <div class="flex justify-between items-center mt-4">
            <div>
                <p class="text-xl font-bold">Total: Php  {{ number_format($order->total_price, 2) }}</p>
            </div>
            <div>
                <a href="{{route('order.details',['orderId' => $order->id])}}" class="bg-cerise-red-500 hover:bg-cerise-red-600 text-white py-2 px-4 rounded-lg">View Details</a>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white p-6  rounded-lg">
        <p class="text-gray-500">You have no past orders.</p>
    </div>
    @endforelse
</div>
