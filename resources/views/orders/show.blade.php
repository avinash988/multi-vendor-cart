@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    Order #{{ $order->id }}
</h2>

<div class="card mb-3">

    <div class="card-body">

        <p>
            <strong>Customer:</strong>
            {{ $order->user->name }}
        </p>

        <p>
            <strong>Vendor:</strong>
            {{ $order->vendor->name }}
        </p>

        <p>
            <strong>Status:</strong>
            {{ $order->status }}
        </p>

        <p>
            <strong>Total:</strong>
            ₹{{ $order->total_amount }}
        </p>

    </div>

</div>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>

    @foreach($order->items as $item)

        <tr>

            <td>{{ $item->product->name }}</td>

            <td>{{ $item->quantity }}</td>

            <td>₹{{ $item->price }}</td>

            <td>
                ₹{{ $item->price * $item->quantity }}
            </td>

        </tr>

    @endforeach

    </tbody>

</table>

@endsection