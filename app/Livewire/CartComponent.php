<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\CartItem;

class CartComponent extends Component
{
    public $cart = [];

    // Listen for addToCart event
    protected $listeners = ['addToCart' => 'addToCart'];

    public function addToCart($productId)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            session()->flash('message', 'You need to log in to add items to your cart.');
            return;
        }

        // Retrieve the product
        $product = Product::find($productId);
        if (!$product) {
            session()->flash('message', 'Product not found.');
            return;
        }

        // Check if the product already exists in the database for the current user
        $cartItem = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();

        // If the product already exists in the cart, update the quantity
        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // Otherwise, create a new cart item
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        // Flash a success message
        session()->flash('message', 'Product added to cart successfully!');
    }

    public function render()
    {
        // Pass the cart data to the view (optionally fetch data from the database as well)
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        
        return view('livewire.cart-component', ['cart' => $cartItems]);
    }
}

