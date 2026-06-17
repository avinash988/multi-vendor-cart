<!DOCTYPE html>
<html>
<head>

    <title>Multi Vendor Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="/products">
            Multi Vendor Checkout
        </a>

        <div>

            <span class="text-white me-3">

                Welcome,
                {{ session('user_name') }}

            </span>

            <a href="/products"
               class="btn btn-light btn-sm">

                Products

            </a>

            <a href="/cart"
               class="btn btn-warning btn-sm">

                Cart

            </a>

            @if(session('user_role') == 'admin')
                <a href="/admin/orders" class="btn btn-info btn-sm">Orders</a>
            @else
                <a href="/my-orders"class="btn btn-info btn-sm">My Orders</a>
            @endif

            <a href="/logout" class="btn btn-danger btn-sm">Logout</a>

        </div>

    </div>

</nav>

<div class="container mt-4">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger">

            {{ $errors->first() }}

        </div>

    @endif

    @yield('content')

</div>

</body>
</html>