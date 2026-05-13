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
            <a class="tf-button style-1 w208" href="{{ route('admin.products.create') }}"><i class="icon-plus"></i>Add new</a>
        </div>
        <div class="wg-table table-product-list">
            <ul class="table-title flex gap20 mb-14">
                <li wire:click="sortBy('name')">
                    <div class="body-title">Product</div>
                </li>

                <li>
                    <div class="body-title">Category</div>
                </li>
                <li>
                    <div class="body-title">Price</div>
                </li>
                <li>
                    <div class="body-title">Quantity</div>
                </li>

                <li>
                    <div class="body-title">Stock</div>
                </li>
                <li>
                    <div class="body-title">Added date</div>
                </li>
                <li>
                    <div class="body-title">Action</div>
                </li>
            </ul>
            <ul class="flex flex-column">
                @forelse($products as $product)
                    <li class="wg-product item-row gap20">
                        <div class="name">
                            <div class="image">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="">
                            </div>
                            <div class="title line-clamp-2 mb-0">
                                <a href="{{ route('products', $product->slug) }}" target="_blank" class="body-text">{{ $product->name }}</a>
                            </div>
                        </div>
                        <div class="body-text text-main-dark mt-4">{{ $product->category->name }}</div>
                        <div class="body-text text-main-dark mt-4">{{ $product->getPrice() }}</div>
                        <div class="body-text text-main-dark mt-4">{{ $product->stock }}</div>
                        <div>
                            <div class="{{ $product->stock > 0 ? 'block-available' : 'block-stock' }} bg-1 fw-7">{{ $product->stock > 0 ? 'In Stock' : 'Out of stock' }}</div>
                        </div>
                        <div class="body-text text-main-dark mt-4">{{ $product->created_at->format('d/m/Y') }}</div>
                        <div class="list-icon-function">
                            <a class="item eye" target="_blank" href="{{ route('products', $product->slug) }}"><i class="icon-eye"></i></a>

                            <a class="item edit" href="{{route('admin.products.edit',$product->id)}}"><i class="icon-edit-3"></i></a>

                            <a class="item trash" data-confirm-delete="true"  href="{{ route('admin.products.destroy', $product->id) }}"><i class="icon-trash-2"></i></a>

                        </div>
                    </li>
                @empty
                    <li class="text-center"><h6>No Product Found</h6></li>
                @endforelse

            </ul>
        </div>
        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10">
            <div class="text-tiny">Showing {{ $paginateNumber }} entries</div>

            {{ $products->links() }}

        </div>
    </div>
</div>
