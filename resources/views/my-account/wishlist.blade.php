@extends('layouts.my-account')

@section('title2', 'Wishlist')

@section('my-account-content')
    <div class="my-account-content account-wishlist">
        <div class="grid-layout wrapper-shop" data-grid="grid-3">
            <!-- card product-->
            @foreach($wishlists as $product)
                <!-- card product 1 -->
                <livewire:product-card :product="$product->product" wire:key="{{ $product->product->id }}"></livewire:product-card>
            @endforeach

    </div>
    {{ $wishlists->links() }}
@endsection
