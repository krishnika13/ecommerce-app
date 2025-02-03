<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Available Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <nav style="background-color: black;" class="p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-white text-xl font-semibold">MUSE</div>
            <div class="space-x-4">
                <a href="#" class="text-gray-300 hover:text-white">Profile</a>
                <a href="#" class="text-gray-300 hover:text-white">Available Products</a>
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Log out</a>
            </div>
        </div>
    </nav>

    <div class="bg-red-800 text-white text-center py-10">
        <h1 class="text-4xl font-bold">MUSE</h1>
        <p class="mt-2 text-lg">Find your perfect clothing style</p>
    </div>

    <div class="container mx-auto mt-4 flex justify-center">
        <input type="text" placeholder="Search for products..." class="w-full max-w-md border rounded px-4 py-2" />
    </div>

    <div class="container mx-auto mt-6">
        <h1 class="text-2xl mb-4">Available Products</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($products as $product)
                <div class="border p-4 rounded shadow-lg flex flex-col justify-between h-64 bg-white">
                    <div>
                        <div class="flex justify-center"> <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover mb-2"> </div>
                        <h2 class="text-lg font-semibold text-center">{{ $product->name }}</h2>
                        <p class="text-gray-700 text-center">{{ $product->description }}</p>
                    </div>
                    <div>
                        <p class="font-bold text-center">RS {{ number_format($product->price, 2) }}</p>
                        <div class="flex justify-center">
                            <a href="{{ route('product.detail', ['productId' => $product->id]) }}" class="mt-2 bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 text-center block">View Product</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>