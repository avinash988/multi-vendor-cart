@extends('layouts.app')

@section('content')

<h2 class="mb-4">My Orders</h2>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Vendor</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

    @foreach($orders as $order)

        <tr>

            <td>{{ $order->id }}</td>

            <td>{{ $order->vendor->name }}</td>

            <td>₹{{ $order->total_amount }}</td>

            <td>{{ $order->status }}</td>

            <td>
                <a href="/order/{{ $order->id }}"
                   class="btn btn-sm btn-primary">
                    View
                </a>
            </td>

        </tr>

    @endforeach

    </tbody>

</table>

@endsection