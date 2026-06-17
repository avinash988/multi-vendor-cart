@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    Admin Orders
</h2>

<form method="GET" class="row mb-3">

    <div class="col-md-3">
        <input type="text"
               name="vendor_name"
               class="form-control"
               placeholder="Vendor Name"
               value="{{ request('vendor_name') }}">
    </div>

    <div class="col-md-3">
        <input type="text"
               name="customer_name"
               class="form-control"
               placeholder="Customer Name"
               value="{{ request('customer_name') }}">
    </div>

    <div class="col-md-3">
       <select name="status" class="form-control">

        <option value="">
            Select Status
        </option>

        <option value="paid"
            {{ request('status') == 'paid' ? 'selected' : '' }}>
            Paid
        </option>

    </select>
    </div>

    <div class="col-md-3">
        <button class="btn btn-primary">Filter</button>
        <a href="/admin/orders" class="btn btn-secondary">Reset</a>
    </div>

</form>

<table class="table table-bordered table-striped">

    <thead>

    <tr>
        <th>ID</th>
        <th>Vendor</th>
        <th>Customer</th>
        <th>Total</th>
        <th>Payment Status</th>
        <th>Action</th>
    </tr>

    </thead>

    <tbody>

    @foreach($orders as $order)

    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->vendor->name }}</td>
        <td>{{ $order->user->name }}</td>
        <td>₹{{ $order->total_amount }}</td>
        <td>{{ $order->payment->status }}</td>
        <td>
            <a href="/order/{{ $order->id }}" class="btn btn-sm btn-primary">View</a>
        </td>
    </tr>

    @endforeach

    </tbody>

</table>

@endsection