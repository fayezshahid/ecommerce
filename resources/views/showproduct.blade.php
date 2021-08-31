@extends('index')

@section('content')
<style>
    .selected {
        border: 1px solid #979797;
    }
    .hover:hover {
        border: 1px solid #979797;
    }
</style>
<div class="products d-flex justify-content-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="filters-content">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 all des">
                            <div class="product-item">
                                <div>
                                    @foreach ($images as $image)
                                        <img src="{{ config('ecommerce.productUrl').$image->image }}" id="currentImage" alt="img" height="300px" width="250px">
                                        @break
                                    @endforeach
                                </div>
                                <div class="down-content">
                                    <a href="#"><h4>{{ $product->name }}</h4></a>
                                    <h6>${{ $product->price}}</h6>
                                    <p>{{ $product->description }}</p>
                                </div>
                                {{-- <div class="d-flex justify-content-between p-4">
                                    @auth
                                        <a href="{{ route('product.buy', $product) }}" class="btn btn-info">Buy Now</a>
                                        <a href="{{ route('cart.store', $product) }}" class="btn btn-warning">Add to Cart</a>
                                    @endauth
                                    @guest
                                        <a href="{{ route('login') }}" class="btn btn-info">Buy Now</a>
                                        <a href="{{ route('login') }}" class="btn btn-warning">Add to Cart</a>
                                    @endguest
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <form action="{{ route('cart.store', $product) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    Color: <input type="text" value="" id="colorName" name="color" style="border-style: none" class="h6">
                                </div>
                                <div class="d-flex justify-content-start">
                                    @for ($i=0; $i<count($images); $i++)
                                        <div class="{{ ($i==0) ? 'selected' : '' }} hover mb-3 mr-3 smallImages">
                                            <img src="{{ config('ecommerce.productUrl').$images[$i]->image }}" alt="img" height="100px" width="100px" name="img">
                                            <input type="hidden" value="{{ $product->colors[$i]->color }}" class="temp">
                                        </div>
                                    @endfor
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Size</label>
                                    <select class="form-select form-control" name="size" value="{{ old('size') }}">
                                        <option selected disabled>Select size</option>
                                        @foreach ($product->sizes as $size)
                                            <option value={{ $size->size }}>
                                                    {{ $size->size }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('size')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Quantity</label>
                                    <input name="quantity" value="{{ old('quantity') }}" type="number" id="qn" class="form-control" id="exampleInputPassword1">
                                    @error('quantity')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="d-flex flex-row-reverse mt-3">
                                    @auth
                                        <button class="btn btn-warning" type="submit">Add to Cart</button>
                                    @endauth
                                    @guest
                                        <a href="{{ route('login') }}" class="btn btn-warning">Add to Cart</a>
                                    @endguest
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function(){

        const currentImage = document.querySelector('#currentImage');
        const colorName = document.querySelector('#colorName');
        const images = document.querySelectorAll('.smallImages');

        colorName.value = document.querySelector('.temp').value;

        images.forEach((element) => element.addEventListener('click', colorClick));

        function colorClick(e){
            currentImage.src = this.querySelector('img').src;
            colorName.value = this.querySelector('input').value;

            images.forEach((element) => element.classList.remove('selected'));
            this.classList.add('selected');
        }
    })();
</script>
@endsection
