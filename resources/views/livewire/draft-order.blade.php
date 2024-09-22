<div class="container mx-auto my-10">
    <!-- Go Back Button -->
    <div class="flex justify-between items-center mb-4">
        <a href="{{route('product.index')}}" class="text-gray-600 hover:text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Go Back
        </a>
        <h2 class="text-3xl font-bold">Cart</h2>
    </div>

    <!-- Draft Order Table -->
    @if ($draftOrder)
        <div class="flex flex-col md:flex-row justify-between">
            <!-- Order Items -->
            <div class="w-full md:w-3/4">
                @foreach ($orderItems as $item)
                    <div class="flex items-center border-b py-4">
                        <!-- Product Image -->
                        <div class="w-24 h-24 bg-gray-100 flex items-center justify-center rounded-md overflow-hidden">
                            <img src="{{$item->product->getImage()}}" alt="{{ $item->product->name }}" class="object-cover w-full h-full">
                        </div>
                        <!-- Product Details -->
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $item->product->code ?? 'Product Code' }}</p>
                        </div>
                        <!-- Quantity Controls -->
                        <div class="flex items-center space-x-4">
                            <!-- Decrement Button -->
                            <button wire:click="decrementQuantity({{ $item->id }})" 
                                    class="w-10 h-10 bg-cerise-red-500 hover:bg-cerise-red-600 text-white rounded-full flex items-center justify-center text-xl font-bold transition duration-200">
                                &minus;
                            </button>
                        
                            <!-- Quantity Display -->
                            <span class="min-w-[50px] text-center py-2 text-lg font-semibold border border-gray-300 rounded-md">
                                {{ $item->quantity }}
                            </span>
                        
                            <!-- Increment Button -->
                            <button wire:click="incrementQuantity({{ $item->id }})" 
                                    class="w-10 h-10 bg-cerise-red-500 hover:bg-cerise-red-600 text-white rounded-full flex items-center justify-center text-xl font-bold transition duration-200">
                                &plus;
                            </button>
                        </div>
                        
                        <!-- Price and Delete -->
                        <div class="text-right ml-4">
                            <p class="text-lg font-bold">{{ number_format($item->price, 2) }}</p>
                            <button wire:click="deleteItem({{ $item->id }})" class="text-red-500 hover:underline text-sm">Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Box -->
            <div class="w-full md:w-1/4 mt-6 md:mt-0 md:ml-6 bg-white p-4 shadow-md rounded-lg">
                <h3 class="text-xl font-bold mb-4">Total</h3>
                <div class="flex justify-between text-lg">
                    <span>Sub-Total</span>
                    <span>Php {{ number_format($draftOrder->total_price, 2) }}</span>
                </div>
                <div class="flex justify-between text-lg mt-4">
                    <span>Delivery</span>
                    <span>Free</span>
                </div>
                <button wire:click="placeOrder" class="mt-6 w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg text-lg font-semibold">Place Order</button>

                <!-- Payment Methods -->
                {{-- <div class="mt-6 text-center">
                    <p class="text-sm text-gray-500">We Accept</p>
                    <div class="flex justify-center mt-2 space-x-4">
                        <img src="https://via.placeholder.com/40x20" alt="PayPal">
                        <img src="https://via.placeholder.com/40x20" alt="Stripe">
                        <img src="https://via.placeholder.com/40x20" alt="Apple Pay">
                    </div>
                </div> --}}
            </div>
        </div>
    @else
        <p class="mt-4 text-center">No items in your draft order.</p>
    @endif
</div>
