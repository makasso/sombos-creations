<div class="offcanvas offcanvas-start canvas-filter" id="filterShop" aria-modal="true" role="dialog">
    <div class="canvas-wrapper">
        <header class="canvas-header header-bg" style="top: 0px;">
            <div class="filter-icon">
                <span class="icon icon-filter"></span>
                <span>Filter</span>
            </div>
            <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        </header>
        <div class="canvas-body">
            {{-- Categories --}}
            <div class="widget-facet wd-categories">
                <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse" aria-expanded="true" aria-controls="categories">
                    <span>Product categories</span>
                    <span class="icon icon-arrow-up"></span>
                </div>
                <div id="categories" class="collapse show">
                    <ul class="list-categoris current-scrollbar mb_36">
                       @if(isset($categories))
                            <li class="cate-item {{ !request()->has('category') ? 'current' : '' }}">
                                <a href="{{ route('shop', request()->except(['category', 'page'])) }}">
                                    <span>All Categories</span>
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li class="cate-item {{ request()->get('category') == $category->id ? 'current' : '' }}">
                                    <a href="{{ route('shop', array_merge(request()->except('page'), ['category' => $category->id])) }}">
                                        <span>{{ ucwords($category->name) }}</span>
                                        <span class="text_black-2">({{ $category->products()->count() }})</span>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            {{-- Collections --}}
            @if(isset($collections) && $collections->count() > 0)
                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#filter-collections" data-bs-toggle="collapse" aria-expanded="true" aria-controls="filter-collections">
                        <span>Collections</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="filter-collections" class="collapse show">
                        <ul class="list-categoris current-scrollbar mb_36">
                            @foreach($collections as $collection)
                                <li class="cate-item {{ request()->get('collection') == $collection->slug ? 'current' : '' }}">
                                    <a href="{{ route('shop', array_merge(request()->except('page'), ['collection' => $collection->slug])) }}">
                                        <span>{{ ucwords($collection->name) }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Tags --}}
            @if(isset($tags) && $tags->count() > 0)
                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#filter-tags" data-bs-toggle="collapse" aria-expanded="true" aria-controls="filter-tags">
                        <span>Tags</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="filter-tags" class="collapse show">
                        <ul class="tf-filter-group current-scrollbar mb_36">
                            @foreach($tags as $tag)
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <a href="{{ route('shop', array_merge(request()->except('page'), ['tag' => $tag->slug])) }}" class="d-flex gap-12 align-items-center {{ request('tag') === $tag->slug ? 'fw-6' : '' }}" style="text-decoration:none; color:inherit;">
                                        <span class="label"><span>{{ ucwords($tag->name) }}</span>&nbsp;<span>({{ $tag->products->count() }})</span></span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="#" id="facet-filter-form" class="facet-filter-form">
                {{-- Availability --}}
                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#availability" data-bs-toggle="collapse" aria-expanded="true" aria-controls="availability">
                        <span>Availability</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="availability" class="collapse show">
                        <ul class="tf-filter-group current-scrollbar mb_36">
                            <li class="list-item d-flex gap-12 align-items-center">
                                <a href="{{ route('shop', array_merge(request()->except('page'), ['availability' => 'in_stock'])) }}" class="d-flex gap-12 align-items-center {{ request('availability') === 'in_stock' ? 'fw-6' : '' }}" style="text-decoration:none; color:inherit;">
                                    <span class="label"><span>In stock</span>&nbsp;<span>({{ $inStockCount ?? 0 }})</span></span>
                                </a>
                            </li>
                            <li class="list-item d-flex gap-12 align-items-center">
                                <a href="{{ route('shop', array_merge(request()->except('page'), ['availability' => 'out_of_stock'])) }}" class="d-flex gap-12 align-items-center {{ request('availability') === 'out_of_stock' ? 'fw-6' : '' }}" style="text-decoration:none; color:inherit;">
                                    <span class="label"><span>Out of stock</span>&nbsp;<span>({{ $outOfStockCount ?? 0 }})</span></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Price --}}
                <div class="widget-facet">
                    <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse" aria-expanded="true" aria-controls="price">
                        <span>Price</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="price" class="collapse show">
                        <div class="widget-price filter-price">
                            <div class="price-val-range" id="price-value-range" data-min="0" data-max="500">
                            </div>
                            <div class="box-title-price">
                                <span class="title-price">Price :</span>
                                <div class="caption-price">
                                    <div class="price-val" id="price-min-value" data-currency="$">{{ request('min_price', 0) }}</div>
                                    <span>-</span>
                                    <div class="price-val" id="price-max-value" data-currency="$">{{ request('max_price', 500) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Dynamic Attributes (Color, Size, etc.) --}}
                @php
                    $attributes = \App\Models\Attribute::with(['values' => function($q) {
                        $q->has('products');
                    }])->get()->filter(fn($a) => $a->values->count() > 0);
                @endphp

                @foreach($attributes as $attribute)
                    @php $attrSlug = \Illuminate\Support\Str::slug($attribute->name); @endphp
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#attr-{{ $attrSlug }}" data-bs-toggle="collapse" aria-expanded="true" aria-controls="attr-{{ $attrSlug }}">
                            <span>{{ ucwords($attribute->name) }}</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="attr-{{ $attrSlug }}" class="collapse show">
                            <ul class="tf-filter-group current-scrollbar mb_36">
                                @foreach($attribute->values as $value)
                                    <li class="list-item d-flex gap-12 align-items-center">
                                        <a href="{{ route('shop', array_merge(request()->except('page'), ['attribute[' . $attrSlug . ']' => $value->value])) }}" class="d-flex gap-12 align-items-center {{ request('attribute.' . $attrSlug) === $value->value ? 'fw-6' : '' }}" style="text-decoration:none; color:inherit;">
                                            @if(strtolower($attribute->name) === 'color')
                                                <span style="width:20px; height:20px; border-radius:50%; display:inline-block; border:1px solid #ddd; background-color:{{ strtolower($value->value) }};"></span>
                                            @endif
                                            <span class="label"><span>{{ ucwords($value->value) }}</span>&nbsp;<span>({{ $value->products->count() }})</span></span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </form>

            {{-- Clear All Filters --}}
            @if(request()->hasAny(['category', 'collection', 'tag', 'availability', 'min_price', 'max_price', 'attribute']))
                <div class="mt_20">
                    <a href="{{ route('shop') }}" class="tf-btn btn-fill radius-3 animate-hover-btn w-100 justify-content-center">
                        <span>Clear All Filters</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
