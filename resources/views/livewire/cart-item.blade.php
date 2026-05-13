<div class="tf-mini-cart-item">
    <div class="tf-mini-cart-image">
        <a href="{{ route('products', $item->product->slug) }}">
            <img src="{{ $item->product->getImage() }}" alt="">
        </a>
    </div>
    <div class="tf-mini-cart-info">
        <a class="title link" href="{{ route('products', $item->product->slug) }}">{{ $item->product->name }}</a>
        {{--                                                <div class="meta-variant">Light gray</div>--}}
        <div class="price fw-6">{{ $item->product->getPrice() }}</div>
        <div class="tf-mini-cart-btns">
            <div class="wg-quantity small">
                <span class="btn-quantity" wire:click="decrement">-</span>
                <input type="text" name="number" value="{{ $quantity }}">
                <span class="btn-quantity" wire:click="increment">+</span>
            </div>
            <div wire:click="deleteItem" class="tf-mini-cart-remove  cursor-pointer border-0" style="cursor: pointer!important;">Remove</div>
        </div>
    </div>
</div>
