@extends('index')

@section('content')
<div class="products">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="filters">
        <ul>
            <a href="{{ route('products') }}"><li>All Products</li></a>
            @foreach ($categories as $category)
                <a href="{{ route('sort', $category->category) }}"><li>{{ $category->category }}</li></a>
            @endforeach
        </ul>
        </div>
    </div>
    @foreach ($products as $product)
    <div class="col-md-4">
        <div class="product-item">
            <div id="carouselExampleControls{{ $product->id }}" class="carousel slide" data-bs-ride="carousel" >
                <ol class="carousel-indicators">
                    @foreach($product->colors as $color)
                        <li style="background: {{ $color->color }}" type="button" data-target="#carouselExampleControls{{ $product->id }}" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" ></li>
                    @endforeach
                </ol>
                <div class="carousel-inner" style="min-height: 300px">
                    @foreach ($product->images as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <a href="{{ route('product.show', $product) }}"><img src="{{ config("ecommerce.productUrl").$image->image }}" alt="item" height="280px" width="400px"></a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="down-content">
                <a href="{{ route('product.show', $product) }}"><h4>{{ $product->name }}</h4></a>
                <h6>${{ $product->price }}</h6>
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>
    @endforeach
    </div>
    {{ $products->links() }}
</div>
</div>
@endsection
