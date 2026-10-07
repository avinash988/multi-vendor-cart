<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopNest — Multi Vendor Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background-color: #f8f9fa; }

        .navbar-brand span { color: #ff6b35; font-weight: 800; }
        .navbar { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%) !important; box-shadow: 0 2px 20px rgba(0,0,0,0.3); }
        .navbar .nav-link { color: rgba(255,255,255,0.85) !important; font-weight: 500; }
        .navbar .nav-link:hover { color: #ff6b35 !important; }

        .btn-cart { background: #ff6b35; border: none; color: white; position: relative; }
        .btn-cart:hover { background: #e85c2a; color: white; }
        .cart-badge { position: absolute; top: -6px; right: -6px; background: #ffd700; color: #000; font-size: 10px; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; }

        .page-header { background: linear-gradient(135deg, #1a1a2e, #0f3460); color: white; padding: 30px 0; margin-bottom: 30px; }
        .page-header h2 { font-weight: 700; margin: 0; }

        .alert { border-radius: 10px; border: none; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-danger { background: #f8d7da; color: #721c24; }
        .alert-warning { background: #fff3cd; color: #856404; }

        .badge-pending { background: #ffc107; color: #000; }
        .badge-paid { background: #28a745; }
        .badge-cancelled { background: #dc3545; }

        footer { background: linear-gradient(135deg, #1a1a2e, #0f3460); color: rgba(255,255,255,0.7); padding: 20px 0; margin-top: 60px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="/products">
            <i class="fas fa-store me-2" style="color:#ff6b35;"></i><span>Shop</span>Nest
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/products"><i class="fas fa-th-large me-1"></i>Products</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <span class="text-white-50 small me-2">
                    <i class="fas fa-user-circle me-1"></i>{{ session('user_name') }}
                </span>

                <a href="/cart" class="btn btn-cart btn-sm position-relative px-3">
                    <i class="fas fa-shopping-cart me-1"></i>Cart
                </a>

                @if(session('user_role') == 'admin')
                    <a href="/admin/orders" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-chart-bar me-1"></i>Admin
                    </a>
                @else
                    <a href="/my-orders" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-box me-1"></i>Orders
                    </a>
                @endif

                <a href="/logout" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center">
            <i class="fas fa-check-circle me-2 fs-5"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger d-flex align-items-center">
            <i class="fas fa-exclamation-circle me-2 fs-5"></i>
            {{ $errors->first() }}
        </div>
    @endif

    @yield('content')
</div>

<footer class="text-center">
    <div class="container">
        <small><i class="fas fa-store me-1" style="color:#ff6b35;"></i><strong style="color:white;">ShopNest</strong> &mdash; Multi Vendor Marketplace &copy; {{ date('Y') }}</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
