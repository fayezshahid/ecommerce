@extends('index')

@section('content')
<div class="products">
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('product.buy', $product) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label><br>
                    <input name="name" value="{{ auth()->user()->name }}" type="name" class="form-control" id="exampleInputfname1" aria-describedby="fnameHelp">
                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input name="email" value="{{ auth()->user()->email }}" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('email')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Address</label>
                    <input name="address" value="{{ old('address') }}" type="text" class="form-control" id="exampleInputPassword1">
                    @error('address')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">City</label>
                    <input name="city" value="{{ old('city') }}" type="text" class="form-control" id="exampleInputPassword1">
                    @error('city')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Phone number</label>
                    <input name="phone" value="{{ old('phone') }}" type="number" class="form-control" id="exampleInputPassword1">
                    @error('phone')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Payment</label>
                    <select class="form-select form-control " name="payment" value="{{ old('payment') }}" id="getFname" aria-label="Default select example" onchange="admSelectCheck(this);">
                        <option selected disabled>Choose payment options</option>
                        <option id="admOption" value="cc">Credit Card</option>
                        <option id="EOption" value="epaisa">Easypaisa</option>
                        <option value="cod">Cash on delivery</option>
                    </select>
                    @error('payment')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div id="admDivCheck" style="display:none;" class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Credit Card Number</label>
                    <input name="creditCardNumber" type="number" value="{{ old('creditCardNumber') }}" class="form-control" id="exampleInputPassword1">
                    @error('creditCardNumber')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div id="EDivCheck" style="display:none;" class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Easypaisa Number</label>
                    <input name="easyPaisaNumber" type="number" value="{{ old('easyPaisaNumber') }}" class="form-control" id="exampleInputPassword1">
                    @error('easyPaisaNumber')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary d-flex jusitfy-content-center">Confirm Order</button>
            </form>
        </div>
        <div class="col-md-4">
            <div class="product-item">
                <img src="{{ config('ecommerce.productUrl').$cart->img }}" alt="img" width="348px" height="280px">
                <div class="down-content">
                    <h4>{{ $cart->name }}</h4>
                    <h6>${{ $cart->price }}</h6>
                    <input name="price" value="{{ $product->price }}" type="hidden" id="price">
                    <div class="text-center mt-2">
                        <h4 style="color: black">Quantity: {{ $cart->quantity }}</h4>
                        <h4 style="color: black">Color: {{ $cart->color }}</h4>
                        <h4 style="color: black">Size: {{ $cart->size }}</h4>
                    </div>
                </div>
                <div class="text-center font-weight-bold">
                    Delivery charges = $1 <br>
                    <div id="total">Total: ${{ $cart->total }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
function admSelectCheck(nameSelect)
{
    console.log(nameSelect);
    if(nameSelect){
        admOptionValue = document.getElementById("admOption").value;
        EOptionValue = document.getElementById("EOption").value;
        if(admOptionValue == nameSelect.value){
            document.getElementById("admDivCheck").style.display = "block";
            document.getElementById("EDivCheck").style.display = "none";
        }
        else if(EOptionValue == nameSelect.value){
            document.getElementById("EDivCheck").style.display = "block";
            document.getElementById("admDivCheck").style.display = "none";
        }
        else{
            document.getElementById("EDivCheck").style.display = "none";
        }
    }
    else{
        document.getElementById("admDivCheck").style.display = "none";
    }
}
function multiply() {
    var form = 0;
    total = document.getElementById('qn').value * document.getElementById('price').value + 1;
    document.getElementById("total").innerHTML = "Total: $" + total;
}

</script>
@endsection
