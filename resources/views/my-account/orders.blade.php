@extends('layouts.my-account')
@section('title2', 'Orders')

@section('my-account-content')
    <div class="my-account-content account-order">
        <div class="wrap-account-order">
            <table>
                <thead>
                <tr>
                    <th class="fw-6">Order</th>
                    <th class="fw-6">Date</th>
                    <th class="fw-6">Status</th>
                    <th class="fw-6">Total</th>
                    <th class="fw-6">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr class="tf-order-item">
                        <td>
                            #{{ $order->id }}
                        </td>
                        <td>
                            {{ $order->created_at->format('F d, Y') }}
                        </td>
                        <td>
                           {{ ucwords($order->status) }}
                        </td>
                        <td>
                            ${{ $order->total_amount }} for {{ $order->items->count()  }} items
                        </td>
                        <td>
                            <a href="{{ route('my-account.orders.details', $order->id) }}" class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                <span>View</span>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="tf-order-item">
                        <td colspan="5" class="text-center text-2">No Order</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
