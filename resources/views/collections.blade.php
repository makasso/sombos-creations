@extends('layouts.main')
@section('title', 'Collections')
@section('content')
    <div class="tf-page-title">
        <div class="container-full">
            <div class="heading text-center">Collections</div>
        </div>
    </div>

    <section class="flat-spacing-1">
        <div class="container">
            <div class="tf-grid-layout xl-col-4 tf-col-2">
                @foreach($collections as $collection)
                    <div class="collection-item hover-img">
                        <div class="collection-inner">
                            <a href="/shop?collection={{ $collection->slug }}" class="collection-image img-style">
                                <img class=" ls-is-cached lazyloaded" data-src="{{ \Illuminate\Support\Facades\Storage::url($collection->image) }}" src="{{ \Illuminate\Support\Facades\Storage::url($collection->image) }}" alt="collection-img">
                            </a>
                            <div class="collection-content">
                                <a href="/shop?collection={{ $collection->slug }}" class="tf-btn collection-title hover-icon"><span>{{ $collection->name }}</span><i class="icon icon-arrow1-top-left"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $collections->links() }}
        </div>
    </section>
@endsection
