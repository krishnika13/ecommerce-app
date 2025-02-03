<div>
    <div class="max-w-4xl mx-auto p-6">
        @if ($product)
            <div class="flex flex-col lg:flex-row-reverse border border-gray-200 rounded-lg shadow-lg p-6 bg-white">
                <div class="w-full lg:w-1/3 mb-6 lg:mb-0">
                    <img src="{{ asset('storage/products/' . $product->image_path) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-64 object-cover rounded-lg">
                </div>

                <div class="w-full lg:w-2/3 lg:pl-6">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
                    <p class="text-gray-600 mt-2">{{ $product->description }}</p>

                    <div class="mt-4">
                        <span class="font-semibold text-gray-700">Sizes:</span>
                        <ul class="flex space-x-2 mt-1">
                            @foreach (explode(',', $product->size) as $size)
                                <li class="px-2 py-1 bg-gray-200 rounded-full text-sm">{{ $size }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-4">
                        <span class="font-semibold text-gray-700">Colors:</span>
                        <div class="flex space-x-2 mt-1">
                            @foreach (explode(',', $product->color) as $color)
                                <div class="w-6 h-6 rounded-full" style="background-color: {{ $color }};"></div>
                            @endforeach
                        </div>
                    </div>

                    <p class="text-lg font-bold mt-4 text-gray-900">RS.{{ $product->price }}</p>

                    <div class="mt-6 flex space-x-2">
                        <button wire:click="addToCart"
                                class="bg-red-800 text-white py-2 px-4 rounded hover:bg-red-600 transition duration-200">
                            Add to Cart
                        </button> 
                        <a href="{{ route('checkout', $product->id) }}"
                           class="bg-red-800 text-white py-2 px-4 rounded hover:bg-red-600 transition duration-200">
                            Buy Now
                        </a>
                    </div>

                    @if (session()->has('message'))
                        <div class="mt-4 text-green-600">{{ session('message') }}</div>
                    @endif
                </div>
            </div>
        @else
            <p class="text-center text-gray-600">Product not found.</p>
        @endif
    </div>
</div>
