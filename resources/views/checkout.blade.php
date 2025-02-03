<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4; /* Light gray background */
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-8 mt-10 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Checkout</h1>


    <form action="{{ route('process.checkout', $product->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="card_number" class="block text-gray-700 font-semibold mb-2">Card Number</label>
            <input type="text" name="card_number" id="card_number" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="**** **** **** 1234" required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="expiry_date" class="block text-gray-700 font-semibold mb-2">Expiry Date</label>
                <input type="text" name="expiry_date" id="expiry_date" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="MM/YYYY" required>
            </div>
            <div>
                <label for="cvv" class="block text-gray-700 font-semibold mb-2">CVV</label>
                <input type="text" name="cvv" id="cvv" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="***" required>
            </div>
        </div>

        <div class="mb-6">
            <label for="address" class="block text-gray-700 font-semibold mb-2">Shipping Address</label>
            <textarea name="address" id="address" class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-blue-500" rows="3" required></textarea>
        </div>

        <button type="submit" class="w-full bg-red-800 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
            Pay Now
        </button>
    </form>
</div>

</body>
</html>