@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-700 mb-1" style="font-weight:700;">All Products</h3>
        <p class="text-muted mb-0 small">Browse products from multiple vendors</p>
    </div>
    <span class="badge rounded-pill" style="background:#0f3460; font-size:13px; padding: 8px 16px;">
        {{ count($products) }} Products
    </span>
</div>

<div class="row g-4">
@foreach($products as $product)
<div class="col-md-4 col-lg-3">
    <div class="card h-100 border-0 shadow-sm" style="border-radius:16px; overflow:hidden; transition: transform 0.2s, box-shadow 0.2s;"
         onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 15px 40px rgba(0,0,0,0.12)'"
         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">

        <div style="background: linear-gradient(135deg, #1a1a2e, #0f3460); padding: 30px; text-align:center;">
            <i class="fas fa-box" style="font-size: 48px; color: rgba(255,255,255,0.3);"></i>
        </div>

        <div class="card-body p-3">
            <h6 class="fw-600 mb-1" style="font-weight:600;">{{ $product->name }}</h6>

            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-store me-1" style="color:#ff6b35; font-size:12px;"></i>
                <small class="text-muted">{{ $product->vendor->name }}</small>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="fw-700 fs-5" style="color:#ff6b35; font-weight:700;">₹{{ number_format($product->price, 2) }}</span>
                @if($product->stock > 0)
                    <span class="badge" style="background:#d4edda; color:#155724; font-size:11px;">
                        <i class="fas fa-check me-1"></i>In Stock ({{ $product->stock }})
                    </span>
                @else
                    <span class="badge" style="background:#f8d7da; color:#721c24; font-size:11px;">Out of Stock</span>
                @endif
            </div>

            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="input-group">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                           class="form-control text-center" style="border-radius:8px 0 0 8px; border:1.5px solid #e0e0e0; max-width:70px;">
                    <button class="btn text-white flex-grow-1" style="background: linear-gradient(135deg, #ff6b35, #f7931e); border-radius:0 8px 8px 0; border:none; font-weight:600;"
                        {{ $product->stock == 0 ? 'disabled' : '' }}>
                        <i class="fas fa-cart-plus me-1"></i>Add to Cart
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
</div>

@endsection
