<div class="h-full p-10 bg-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as  $key=> $product)
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
          
            <img class="w-full h-48 object-cover" src="{{ $product->getImage() }}" alt="{{ $product->name }}">
          
            <div class="p-6">
                <h2 class="text-lg font-bold text-gray-800">{{ $product->name }}</h2>
                <p class="mt-2 text-sm text-gray-600">
                    {{ $product->description }}
                </p>
                <div class="mt-4">
                    <span class="text-xl font-bold text-gray-900">Php {{ number_format($product->price, 2) }}</span>
                </div>
                <div class="mt-4">

                    {{ ($this->addToCartAction)(['record' => $product->id]) }}

                    {{-- <button class="w-full bg-cerise-red-500 text-white font-semibold py-2 px-4 rounded hover:bg-cerise-red-600">
                        Add to Cart
                    </button> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <x-filament-actions::modals />
</div>
