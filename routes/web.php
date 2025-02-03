<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/product-list', function () {
        return view('livewire.product-list');
    })->name('product.list');
});

use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::post('/login', [AuthenticatedSessionController::class, 'store']); 

Route::get('/product-list', function () {
    // Assuming you want to fetch products from the database
    $products = App\Models\Product::all(); // Fetch all products from the database

    return view('livewire.product-list', compact('products')); // Pass products to the view
})->name('product.list');

use App\Livewire\ProductDetail;

Route::get('/product/{productId}', ProductDetail::class)->name('product.detail');


Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');



use App\Http\Controllers\OrderController;

Route::get('/checkout/{productId}', [OrderController::class, 'showCheckoutForm'])->name('checkout');
Route::post('/checkout/{productId}', [OrderController::class, 'processCheckout'])->name('process.checkout');

Route::middleware(['auth'])->group(function () {
    // Define the orders.index route
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

use App\Http\Controllers\AuthController; 

Route::post('/login', [AuthController::class, 'login']);  // Route for login
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Route for logout (protected)


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');