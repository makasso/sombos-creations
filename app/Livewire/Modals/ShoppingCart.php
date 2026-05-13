<?php

namespace App\Livewire\Modals;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ShoppingCart extends Component
{
    use LivewireAlert;

    public $items = [];
    public $subTotal = 0;

    protected $listeners = ['cart:updated' => 'updateCart'];

    public function mount()
    {
        $this->updateCart();
    }

    public function updateCart()
    {
        if (Auth::check()) {
            $this->items = Auth::user()->cart()->with('product')->get();
        } else {
            $sessionCart = Session::get('cart', []);
            $items = collect();

            foreach ($sessionCart as $entry) {
                $product = Product::find($entry['product_id']);
                if ($product) {
                    $items->push((object) [
                        'product_id' => $entry['product_id'],
                        'quantity' => $entry['quantity'],
                        'product' => $product,
                    ]);
                }
            }

            $this->items = $items;
        }

        $this->subTotal = 0;

        foreach ($this->items as $item) {
            $this->subTotal += ($item->product->price * $item->quantity);
        }

        $this->subTotal = number_format($this->subTotal, 2);

        $this->dispatch('cart:count', count($this->items));
    }

    public function render()
    {

        return view('livewire.modals.shopping-cart');
    }
}
