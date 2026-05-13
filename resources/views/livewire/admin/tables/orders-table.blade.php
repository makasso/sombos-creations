<div>
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap mb-20">
            <div class="wg-filter flex-grow">
                <div class="show">
                    <div class="text-tiny">Showing</div>
                    <div class="select">
                        <select wire:model.live.debounce.500ms="paginateNumber">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="text-tiny">entries</div>
                </div>
                <form class="form-search" onsubmit="return false;">
                    <fieldset class="name">
                        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search order, customer..." class="">
                    </fieldset>
                    <div class="button-submit">
                        <button class="" type="button"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="flex gap10">
                <select wire:model.live="statusFilter" class="select-custom" style="border:1px solid #e0e0e0;border-radius:6px;padding:6px 12px;font-size:13px;">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <select wire:model.live="paymentFilter" class="select-custom" style="border:1px solid #e0e0e0;border-radius:6px;padding:6px 12px;font-size:13px;">
                    <option value="">All Payments</option>
                    <option value="pending">Unpaid</option>
                    <option value="paid">Paid</option>
                    <option value="failed">Failed</option>
                    <option value="refunded">Refunded</option>
                </select>
            </div>
        </div>

        <div class="wg-table table-order-list">
            <ul class="table-title flex gap20 mb-14">
                <li style="flex:0.5;"><div class="body-title">#ID</div></li>
                <li style="flex:2;"><div class="body-title">Customer</div></li>
                <li style="flex:1.5;"><div class="body-title">Items</div></li>
                <li style="flex:1;"><div class="body-title">Total</div></li>
                <li style="flex:1;"><div class="body-title">Status</div></li>
                <li style="flex:1;"><div class="body-title">Payment</div></li>
                <li style="flex:1;"><div class="body-title">Date</div></li>
                <li style="flex:0.8;"><div class="body-title">Action</div></li>
            </ul>
            <ul class="flex flex-column">
                @forelse($orders as $order)
                @php
                    $statusColors = ['pending'=>'#ff9800','processing'=>'#2196f3','shipped'=>'#9c27b0','completed'=>'#4caf50','cancelled'=>'#f44336'];
                    $payColors    = ['pending'=>'#ff9800','paid'=>'#4caf50','failed'=>'#f44336','refunded'=>'#9e9e9e'];
                @endphp
                <li class="wg-product item-row gap20">
                    <div style="flex:0.5;" class="body-text text-secondary">#{{ $order->id }}</div>
                    <div style="flex:2;">
                        <div class="body-text fw-6">
                            {{ $order->user ? $order->user->firstname.' '.$order->user->lastname : $order->guest_firstname.' '.$order->guest_lastname }}
                        </div>
                        <div class="text-tiny text-secondary">
                            {{ $order->user ? $order->user->email : $order->guest_email }}
                            @if($order->isGuest()) <span style="background:#eee;padding:1px 6px;border-radius:3px;">Guest</span>@endif
                        </div>
                    </div>
                    <div style="flex:1.5;" class="text-tiny text-secondary">{{ $order->items->count() ?? '—' }} item(s)</div>
                    <div style="flex:1;" class="body-text fw-6">${{ number_format($order->total_amount, 2) }}</div>
                    <div style="flex:1;">
                        <span style="background:{{ $statusColors[$order->status] ?? '#999' }}22;color:{{ $statusColors[$order->status] ?? '#999' }};padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;text-transform:capitalize;white-space:nowrap;">
                            {{ $order->status }}
                        </span>
                    </div>
                    <div style="flex:1;">
                        <span style="background:{{ $payColors[$order->payment_status] ?? '#999' }}22;color:{{ $payColors[$order->payment_status] ?? '#999' }};padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;text-transform:capitalize;white-space:nowrap;">
                            {{ $order->payment_status }}
                        </span>
                    </div>
                    <div style="flex:1;" class="text-tiny text-secondary">{{ $order->created_at->format('d M Y') }}</div>
                    <div style="flex:0.8;" class="list-icon-function">
                        <a class="item eye" href="{{ route('admin.orders.show', $order->id) }}"><i class="icon-eye"></i></a>
                        <a class="item trash" data-confirm-delete="true" href="{{ route('admin.orders.destroy', $order->id) }}"><i class="icon-trash-2"></i></a>
                    </div>
                </li>
                @empty
                <li class="text-center py-3"><h6>No orders found</h6></li>
                @endforelse
            </ul>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10">
            <div class="text-tiny">Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} entries</div>
            {{ $orders->links() }}
        </div>
    </div>
</div>
