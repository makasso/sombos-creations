<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class ProductCard extends Component
{
    use LivewireAlert;

    public $product;

    public function render()
    {
        return view('livewire.product-card');
    }

    public function addToCart()
    {
        if ($this->product->stock <= 0) {
            $this->alert('error', 'This product is out of stock!');
            return;
        }

        if (Auth::check()) {
            Cart::updateOrCreate([
                'product_id' => $this->product->id,
                'user_id' => Auth::id(),
            ], ['quantity' => 1]);
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$this->product->id])) {
                $this->alert('warning', 'Product already in the cart!');
                return;
            }

            $cart[$this->product->id] = [
                'product_id' => $this->product->id,
                'quantity' => 1,
            ];

            Session::put('cart', $cart);
        }

        $this->dispatch('cart:updated');

        $this->alert('success', 'Product added to cart!');

        // Open the shopping cart modal
        $this->js("bootstrap.Modal.getOrCreateInstance(document.getElementById('shoppingCart')).show()");
    }

    public function addToWishlist()
    {
        if (!Auth::check()) {
            $this->alert('error', 'Please log in to add to wishlist');
            return;
        }

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $this->product->id,
        ]);

        $this->dispatch('wishlist:updated', Wishlist::where('user_id', Auth::id())->count());

        $this->alert('success', 'Product added to wishlist');
    }

    // Call this method on button click
    public function openQuickView()
    {
        $this->dispatch('openQuickView', $this->product->id);
    }

}
