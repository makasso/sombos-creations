<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Masmerise\Toaster\Toaster;
use Livewire\Component;

class CartItem extends Component
{
    public $item;
    public $quantity = 1;

    public function mount($item)
    {
        $this->item = $item;
        $this->quantity = $item->quantity;
    }

    public function increment()
    {
        if ($this->quantity >= $this->item->product->stock) {
            $this->quantity = $this->item->product->stock;
            Toaster::warning('Product stock limit reached!');
            return;
        }

        $this->quantity++;
        $this->updateQuantity();
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->updateQuantity();
        }
    }

    public function deleteItem()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $this->item->product->id)
                ->delete();
        } else {
            $cart = Session::get('cart', []);
            unset($cart[$this->item->product_id]);
            Session::put('cart', $cart);
        }

        Toaster::success('Item has been deleted!');
        $this->dispatch('cart:updated');
    }

    public function updateQuantity()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $this->item->product->id)
                ->update(['quantity' => $this->quantity]);
        } else {
            $cart = Session::get('cart', []);

            $cart[$this->item->product->id] = [
                'product_id' => $this->item->product->id,
                'quantity' => $this->quantity,
            ];

            Session::put('cart', $cart);

        }

        $this->dispatch('cart:updated');
    }

    public function render()
    {
        return view('livewire.cart-item');
    }
}
