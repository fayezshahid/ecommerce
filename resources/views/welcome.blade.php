@extends('index')

@section('content')
<div class="latest-products">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="section-heading">
        <h2>Latest Products</h2>
        <div class="d-flex flex-row-reverse">
            <a href="{{ route('products') }}">view all products <i class="fa fa-angle-right"></i></a>
        </div>
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
                    <a href="{{ route('product.show', $product->id) }}"><h4>{{ $product->name }}</h4></a>
                    <h6>${{ $product->price }}</h6>
                    <p>{{ $product->description }}</p>
                    <ul class="stars">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    </ul>
                    <span>Reviews (24)</span>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
</div>

<div class="best-features">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="section-heading">
        <h2>About Sixteen Clothing</h2>
        </div>
    </div>
    <div class="col-md-6">
        <div class="left-content">
        <h4>Looking for the best products?</h4>
        <p><a rel="nofollow" href="https://templatemo.com/tm-546-sixteen-clothing" target="_parent">This template</a> is free to use for your business websites. However, you have no permission to redistribute the downloadable ZIP file on any template collection website. <a rel="nofollow" href="https://templatemo.com/contact">Contact us</a> for more info.</p>
        <ul class="featured-list">
            <li><a href="#">Lorem ipsum dolor sit amet</a></li>
            <li><a href="#">Consectetur an adipisicing elit</a></li>
            <li><a href="#">It aquecorporis nulla aspernatur</a></li>
            <li><a href="#">Corporis, omnis doloremque</a></li>
            <li><a href="#">Non cum id reprehenderit</a></li>
        </ul>
        <a href="about.html" class="filled-button">Read More</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="right-image">
        <img src="assets/images/feature-image.jpg" alt="">
        </div>
    </div>
    </div>
</div>
</div>


<div class="call-to-action">
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="inner-content">
        <div class="row">
            <div class="col-md-8">
            <h4>Creative &amp; Unique <em>Sixteen</em> Products</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque corporis amet elite author nulla.</p>
            </div>
            <div class="col-md-4">
            <a href="#" class="filled-button">Purchase Now</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
</div>

@endsection
