<?php

namespace App\Livewire\Modals;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Masmerise\Toaster\Toaster;
use Livewire\Component;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class QuickView extends Component
{
    public $product;
    public $quantity = 1;
    public $price = 0;
    public $isProcessing = false;

    protected $listeners = ['openQuickView' => 'loadProduct'];

    public function mount()
    {

    }

    public function loadProduct($productId)
    {
        $this->product = Product::find($productId);
        // Optionally, reset quantity or other properties
        $this->quantity = 1;

        $this->price = number_format(floatval($this->product->price), 2);
    }

    public function addToCart()
    {
        if ($this->product->stock <= 0) {
            Toaster::error('This product is out of stock!');
            return;
        }

        if (Auth::check()) {
            Cart::updateOrCreate([
                'product_id' => $this->product->id,
                'user_id' => Auth::id(),
            ]);
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$this->product->id])) {
                Toaster::warning('Product already in the cart!');
                return;
            } else {
                $cart[$this->product->id] = [
                    'product_id' => $this->product->id,
                    'quantity' => 1,
                    'product' => Product::find($this->product->id),
                ];
            }
            $cart = collect($cart);
            Session::put('cart', $cart);
        }

        $this->dispatch('cart:updated');

        Toaster::success('Product added to cart!');
    }

    public function addToWishlist()
    {
        if (!Auth::check()) {
            Toaster::error('Please log in to add to wishlist');
            return;
        }

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $this->product->id,
        ]);

        $this->dispatch('wishlist:updated', Wishlist::where('user_id', Auth::id())->count());

        Toaster::success('Product added to wishlist');
    }

    public function increment(): void
    {
        if ($this->quantity === $this->product->stock) {
            $this->quantity = $this->product->stock;

            Toaster::warning('Product stock limit reached!');
        } else {
            $this->quantity++;
        }

        $this->updateQuantity();

    }

    public function decrement(): void
    {
        if ($this->quantity > 1) {
            $this->quantity--;

            $this->updateQuantity();
        }

    }

    public function updateQuantity(): void
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
                'product' => Product::find($this->product->id),
            ];

            $cart = collect($cart);
            Session::put('cart', $cart);

        }

        $this->price = number_format(floatval($this->product->price * $this->quantity), 2);

    }

    public function buyNow()
    {

        if (! Auth::check()) {
            Toaster::error('Please login to pay directly with Paypal');
            return;
        }
        // Calculate the total amount (for simplicity, product price * quantity)
        $amount = $this->product->price * $this->quantity;

        // Create a new instance of the PayPal client
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $amount,
            'shipping_address' => Auth::user()->address ?? 'Unknown',
        ]);

        $order->items()->create([
            'product_id' => $this->product->id,
            'quantity' => $this->quantity,
            'price' => $this->product->price,
        ]);

        // Create the order with required parameters
        $paypalOrder = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount,
                    ]
                ]
            ],
            "application_context" => [
                "return_url" => route('paypal.success', ['order_id' => $order->id]),
                "cancel_url" => route('paypal.cancel'),
            ],
        ]);

        // Look for the approval link in the order response
        $approvalUrl = null;
        foreach ($paypalOrder['links'] as $link) {
            if ($link['rel'] === 'approve') {
                $approvalUrl = $link['href'];
                break;
            }
        }

        if ($approvalUrl) {
            // Dispatch a browser event with the approval URL so JS can redirect the user

            $this->dispatch('redirectToPayPal', ['url' => $approvalUrl]);
        } else {
            // Dispatch an error event if something went wrong
            Toaster::error('Unable to process your request!');
        }

        $this->isProcessing = true;
    }
    public function render()
    {
        return view('livewire.modals.quick-view');
    }
}
