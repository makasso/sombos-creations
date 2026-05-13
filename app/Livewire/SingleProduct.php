<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SingleProduct extends Component

{
    use LivewireAlert;

    public $product;
    public $quantity = 1;
    public $isProcessing = false;

    // Review fields
    public $reviewRating = 0;
    public $reviewComment = '';

    public function mount($product)
    {
        $this->product = $product->load(['tags', 'category', 'reviews.user', 'attributes.attribute']);
    }

    public function render()
    {
        return view('livewire.single-product');
    }

    public function submitReview()
    {
        $this->validate([
            'reviewRating' => 'required|integer|min:1|max:5',
            'reviewComment' => 'nullable|string|max:1000',
        ]);

        if (!Auth::check()) {
            $this->alert('error', 'Please log in to submit a review.');
            return;
        }

        // Check if user already reviewed this product
        $existing = Review::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($existing) {
            $this->alert('warning', 'You have already reviewed this product.');
            return;
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $this->product->id,
            'rating' => $this->reviewRating,
            'comment' => $this->reviewComment,
        ]);

        $this->reviewRating = 0;
        $this->reviewComment = '';
        $this->product->refresh();

        $this->alert('success', 'Review submitted successfully!');
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
            ], ['quantity' => $this->quantity]);
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$this->product->id])) {
                $this->alert('warning', 'Product already in the cart!');
                return;
            }

            $cart[$this->product->id] = [
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
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

    public function increment()
    {
        if ($this->quantity === $this->product->stock) {
            $this->quantity = $this->product->stock;

            $this->alert('warning', 'Product stock limit reached!');
        } else {
            $this->quantity++;
        }

        $this->updateQuantity();

    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;

            $this->updateQuantity();
        }
    }

    public function updateQuantity()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $this->product->id)
                ->update(['quantity' => $this->quantity]);
        } else {
            $cart = Session::get('cart', []);

            $cart[$this->product->id] = [
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
            ];

            Session::put('cart', $cart);

        }

        $this->dispatch('cart:updated');
    }

    public function buyNow()
    {
        if ($this->product->stock <= 0) {
            $this->alert('error', 'This product is out of stock!');
            return;
        }

        // Add product to cart and redirect to checkout for both guests and logged-in users
        if (Auth::check()) {
            Cart::updateOrCreate([
                'product_id' => $this->product->id,
                'user_id' => Auth::id(),
            ], ['quantity' => $this->quantity]);
        } else {
            $cart = Session::get('cart', []);
            $cart[$this->product->id] = [
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
            ];
            Session::put('cart', $cart);
        }

        return redirect()->route('checkout');
    }


}
