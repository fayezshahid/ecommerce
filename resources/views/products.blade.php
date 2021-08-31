@extends('index')

@section('content')
<div class="products">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="filters">
            <ul>
                <a href="{{ route('products') }}"><li class="active">All Products</li></a>
                @foreach ($categories as $category)
                    <a href="{{ route('sort', $category->category) }}"><li>{{ $category->category }}</li></a>
                @endforeach
                {{-- <a href="{{ route('winter') }}"><li>Winter wear</li></a>
                <a href="{{ route('all') }}"><li>All Season wear</li></a> --}}
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
                        {{-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: black"></span>
                            <span class="sr-only">Next</span>
                        </a> --}}
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
