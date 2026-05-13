<tr class="tf-cart-item file-delete">
    <td class="tf-cart-item_product">
        <a href="{{ route('products', $item->product->slug) }}" class="img-box">
            <img src="{{ $item->product->getImage() }}" alt="img-product">
        </a>
        <div class="cart-info">
            <a href="{{ route('products', $item->product->slug) }}"
               class="cart-title link">{{ $item->product->name }}</a>
            {{--<div class="cart-meta-variant">White / M</div>--}}
            <span class="remove-cart link remove" wire:click="deleteItem" style="cursor:pointer;">Remove</span>
        </div>
    </td>
    <td class="tf-cart-item_price tf-variant-item-price" cart-data-title="Price">
        <div class="cart-price price">{{ $item->product->getPrice() }}</div>
    </td>
    <td class="tf-cart-item_quantity" cart-data-title="Quantity">
        <div class="cart-quantity">
            <div class="wg-quantity">
                    <span class="btn-quantity btndecrease" wire:click="decrement">
                        <svg class="d-inline-block" width="9" height="1"viewBox="0 0 9 1" fill="currentColor">
                            <path d="M9 1H5.14286H3.85714H0V1.50201e-05H3.85714L5.14286 0L9 1.50201e-05V1Z"></path>
                        </svg>
                    </span>
                <input type="text" name="number" value="{{ $quantity }}" readonly>
                <span class="btn-quantity btnincrease" wire:click="increment">
                        <svg class="d-inline-block" width="9" height="9"viewBox="0 0 9 9" fill="currentColor">
                            <path d="M9 5.14286H5.14286V9H3.85714V5.14286H0V3.85714H3.85714V0H5.14286V3.85714H9V5.14286Z"></path>
                        </svg>
                    </span>
            </div>
        </div>
    </td>
    <td class="tf-cart-item_total tf-variant-item-total" cart-data-title="Total">
        <div class="cart-total price">
            ${{ number_format(floatval($item->product->price * $quantity), 2) }}</div>
    </td>
</tr>
