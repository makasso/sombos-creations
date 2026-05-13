<?php

namespace App\Livewire\Modals;

use App\Models\Product;
use Livewire\Component;

class QuickAdd extends Component
{
    public $product;
    public $quantity = 1;

    protected $listeners = ['openQuickAdd' => 'loadProduct'];

    public function loadProduct($productId)
    {
        $this->product = Product::find($productId);
        // Optionally, reset quantity or other properties
        $this->quantity = 1;
    }

    public function addToCart()
    {
        // Validate quantity, add product to the cart
        // e.g., Cart::add($this->product, $this->quantity);
        $this->emit('cartUpdated');
    }
    public function render()
    {
        return view('livewire.modals.quick-add');
    }
}
