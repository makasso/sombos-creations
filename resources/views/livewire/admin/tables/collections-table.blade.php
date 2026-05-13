<div>
    <div class="wg-box">

        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <div class="show">
                    <div class="text-tiny">Showing</div>
                    <div class="select">
                        <select wire:model.live.debounce.500ms="paginateNumber" class="">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                    <div class="text-tiny">entries</div>
                </div>
                <form class="form-search">
                    <fieldset class="name">
                        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search here..." class="">
                    </fieldset>
                    <div class="button-submit">
                        <button class="" type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <a class="tf-button style-1 w208" href="{{ route('admin.collections.create') }}"><i class="icon-plus"></i>Add new</a>
        </div>
        <div class="wg-table table-product-list">
            <ul class="table-title flex gap20 mb-14">
                <li>
                    <div class="body-title">Collection</div>
                </li>
                <li>
                    <div class="body-title">Added date</div>
                </li>
                <li>
                    <div class="body-title">Action</div>
                </li>
            </ul>
            <ul class="flex flex-column">
                @forelse($collections as $collection)
                    <li class="wg-product item-row gap20">
                        <div class="name">
                            <div class="image">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($collection->image) }}" alt="">
                            </div>
                            <div class="title line-clamp-2 mb-0">
                                <span class="body-text">{{ $collection->name }}</span>
                            </div>
                        </div>
                        <div class="body-text text-main-dark mt-4">{{ $collection->created_at->format('d/m/Y') }}</div>
                        <div class="list-icon-function">
                            <a class="item eye" href="{{ route('admin.collections.show', $collection->id) }}"><i class="icon-eye"></i></a>

                            <a class="item edit" href="{{route('admin.collections.edit',$collection->id)}}"><i class="icon-edit-3"></i></a>

                            <a class="item trash" data-confirm-delete="true"  href="{{ route('admin.collections.destroy', $collection->id) }}"><i class="icon-trash-2"></i></a>

                        </div>
                    </li>
                @empty
                    <li class="text-center">No Collection Yet</li>
                @endforelse

            </ul>
        </div>
        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10">
            <div class="text-tiny">Showing {{ $paginateNumber }} entries</div>

            {{ $collections->links() }}

        </div>
    </div>
</div>
