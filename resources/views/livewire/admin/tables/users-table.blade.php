<div>
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
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
                        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search name, email..." class="">
                    </fieldset>
                    <div class="button-submit">
                        <button type="button"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="wg-table mt-20">
            <ul class="table-title flex gap20 mb-14">
                <li style="flex:0.5;"><div class="body-title">#</div></li>
                <li style="flex:2;"><div class="body-title">Name</div></li>
                <li style="flex:2;"><div class="body-title">Email</div></li>
                <li style="flex:1;"><div class="body-title">Phone</div></li>
                <li style="flex:0.8;"><div class="body-title">Orders</div></li>
                <li style="flex:0.8;"><div class="body-title">Role</div></li>
                <li style="flex:1;"><div class="body-title">Joined</div></li>
                <li style="flex:0.8;"><div class="body-title">Action</div></li>
            </ul>
            <ul class="flex flex-column">
                @forelse($users as $user)
                <li class="wg-product item-row gap20">
                    <div style="flex:0.5;" class="body-text text-secondary">{{ $user->id }}</div>
                    <div style="flex:2;">
                        <div class="body-text fw-6">{{ $user->firstname }} {{ $user->lastname }}</div>
                    </div>
                    <div style="flex:2;" class="text-tiny text-secondary">{{ $user->email }}</div>
                    <div style="flex:1;" class="text-tiny text-secondary">{{ $user->phone ?? '—' }}</div>
                    <div style="flex:0.8;" class="body-text">{{ $user->orders_count }}</div>
                    <div style="flex:0.8;">
                        @if($user->role === 'admin')
                            <span style="background:#e3f2fd;color:#1565c0;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;">Admin</span>
                        @else
                            <span style="background:#f3f4f6;color:#555;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;">Customer</span>
                        @endif
                    </div>
                    <div style="flex:1;" class="text-tiny text-secondary">{{ $user->created_at->format('d M Y') }}</div>
                    <div style="flex:0.8;" class="list-icon-function">
                        <a class="item eye" href="{{ route('admin.users.show', $user->id) }}"><i class="icon-eye"></i></a>
                        @if(auth()->id() !== $user->id)
                        <a class="item trash" data-confirm-delete="true" href="{{ route('admin.users.destroy', $user->id) }}"><i class="icon-trash-2"></i></a>
                        @endif
                    </div>
                </li>
                @empty
                <li class="text-center py-3"><h6>No users found</h6></li>
                @endforelse
            </ul>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10">
            <div class="text-tiny">Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} entries</div>
            {{ $users->links() }}
        </div>
    </div>
</div>
