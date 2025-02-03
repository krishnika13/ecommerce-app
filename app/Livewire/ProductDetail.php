<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Component
{
    public $productId;
    public $product;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->product = Product::find($this->productId);

        // Handle the case where the product is not found
        if (!$this->product) {
            abort(404); // Or redirect, or display a message
        }
    }

    

    public function addToCart()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            session()->flash('message', 'You need to log in to add items to your cart.');
            return;
        }

        // Get the current cart from session (if any)
        $cart = session()->get('cart', []);

        // Check if the product already exists in the cart
        $exists = false;
        foreach ($cart as &$item) {
            if ($item['product_id'] == $this->product->id) {
                $item['quantity']++;
                $exists = true;
                break;
            }
        }

        // If the product doesn't exist in the cart, add it
        if (!$exists) {
            $cart[] = [
                'product_id' => $this->product->id,
                'quantity' => 1,
                'price' => $this->product->price,
            ];
        }

        // Store the updated cart in session
        session()->put('cart', $cart);

        // Flash a success message
        session()->flash('message', 'Added to cart successfully!');
    }

    public function render()
{
    if (!$this->product) {
        dd('Product not found!'); // This will stop execution and show this message
    }
    return view('livewire.product-detail')
    ->layout('layouts.app');
}

}
