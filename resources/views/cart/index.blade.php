@extends('layouts.app')

@section('content')

<h2 class="mb-4">Cart</h2>

@if($cart && count($cart->items))

<table class="table table-bordered">

    <thead>

    <tr>
        <th>Product</th>
        <th>Vendor</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Action</th>
    </tr>

    </thead>

    <tbody>

    @foreach($cart->items as $item)

    <tr>

        <td>
            {{ $item->product->name }}
        </td>

        <td>
            {{ $item->product->vendor->name }}
        </td>

        <td>
            {{ $item->quantity }}
        </td>

        <td>
            ₹{{ $item->product->price }}
        </td>

        <td>

            <form action="/cart/remove/{{ $item->id }}"
                  method="POST">

                @csrf

                <button
                    class="btn btn-danger btn-sm">

                    Remove

                </button>

            </form>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

<form action="{{ route('checkout') }}"
      method="POST">

    @csrf

    <button class="btn btn-success">
        Checkout
    </button>

</form>

@else

<div class="alert alert-warning">
    Cart Empty
</div>

@endif

@endsection