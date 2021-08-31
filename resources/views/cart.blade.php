@extends('index')

@section('content')
    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td><img src="{{ config('ecommerce.productUrl').$cart->img }}" alt="img" height="100px" width="100px"></td>
                                    <td>{{ $cart->name }}</td>
                                    <td>{{ $cart->color }}</td>
                                    <td>{{ $cart->size }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    <td>${{ $cart->price }}</td>
                                    <td>${{ $cart->total + 1}}</td>
                                    <td>
                                        <div class="d-flex justify content-center">
                                            <a href="{{ route('product.buy', $cart->product_id) }}" class="btn btn-info ml-5">Checkout</a>
                                            <form action="{{ route('cart.delete', $cart->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ml-5">Delete Item</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
