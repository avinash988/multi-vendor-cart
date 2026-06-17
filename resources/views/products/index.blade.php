@extends('layouts.app')

@section('content')

<h2 class="mb-4">Products</h2>

<div class="row">

@foreach($products as $product)

<div class="col-md-3 mb-4">

    <div class="card">

        <div class="card-body">

            <h5>{{ $product->name }}</h5>

            <p>
                Vendor:
                {{ $product->vendor->name }}
            </p>

            <p>
                Price:
                ₹{{ $product->price }}
            </p>

            <p>
                Stock:
                {{ $product->stock }}
            </p>

            <form action="{{ route('cart.add') }}" method="POST">

                @csrf

                <input type="hidden"
                       name="product_id"
                       value="{{ $product->id }}">

                <input type="number"
                       name="quantity"
                       value="1"
                       min="1"
                       class="form-control mb-2">

                <button class="btn btn-primary w-100">
                    Add To Cart
                </button>

            </form>

        </div>

    </div>

</div>

@endforeach

</div>

@endsection