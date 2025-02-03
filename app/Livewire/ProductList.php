<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductList extends Component
{
    public $products;

    public function mount()
    {
        // Fetch all products from the database
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.product-list');
    }
}