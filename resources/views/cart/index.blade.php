@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h3 class="fw-700 mb-1" style="font-weight:700;">
        <i class="fas fa-shopping-cart me-2" style="color:#ff6b35;"></i>My Cart
    </h3>
    <p class="text-muted mb-0 small">Review your items before checkout</p>
</div>

@if($cart && count($cart->items))

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0" style="border-radius:16px; overflow:hidden;">
                        <thead>
                            <tr style="background:#f8f9fa;">
                                <th class="px-4 py-3 border-0" style="font-size:13px; color:#666; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Product</th>
                                <th class="py-3 border-0" style="font-size:13px; color:#666; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Vendor</th>
                                <th class="py-3 border-0" style="font-size:13px; color:#666; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Qty</th>
                                <th class="py-3 border-0" style="font-size:13px; color:#666; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Price</th>
                                <th class="py-3 border-0" style="font-size:13px; color:#666; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Subtotal</th>
                                <th class="py-3 border-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart->items as $item)
                        @php $subtotal = $item->product->price * $item->quantity; $total += $subtotal; @endphp
                        <tr style="border-color:#f0f0f0;">
                            <td class="px-4 py-3 align-middle">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width:45px;height:45px;background:linear-gradient(135deg,#1a1a2e,#0f3460);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-box" style="color:rgba(255,255,255,0.4);font-size:18px;"></i>
                                    </div>
                                    <span class="fw-600" style="font-weight:600;">{{ $item->product->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 align-middle">
                                <small class="text-muted"><i class="fas fa-store me-1" style="color:#ff6b35;font-size:11px;"></i>{{ $item->product->vendor->name }}</small>
                            </td>
                            <td class="py-3 align-middle">
                                <form action="/cart/update/{{ $item->id }}" method="POST" class="d-flex align-items-center gap-1">
                                    @csrf
                                    <button type="button" onclick="changeQty(this, -1)" class="btn btn-sm" style="background:#f0f0f0;border:none;border-radius:6px;width:28px;height:28px;padding:0;font-size:16px;line-height:1;">−</button>
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                           style="width:50px;text-align:center;border:1.5px solid #e0e0e0;border-radius:8px;padding:3px;font-size:14px;font-weight:600;">
                                    <button type="button" onclick="changeQty(this, 1)" class="btn btn-sm" style="background:#f0f0f0;border:none;border-radius:6px;width:28px;height:28px;padding:0;font-size:16px;line-height:1;">+</button>
                                    <button type="submit" class="btn btn-sm ms-1" style="background:#0f3460;color:white;border:none;border-radius:6px;padding:4px 8px;font-size:11px;">Update</button>
                                </form>
                            </td>
                            <td class="py-3 align-middle" style="color:#ff6b35;font-weight:600;">₹{{ number_format($item->product->price, 2) }}</td>
                            <td class="py-3 align-middle fw-700" style="font-weight:700;color:#1a1a2e;">₹{{ number_format($subtotal, 2) }}</td>
                            <td class="py-3 align-middle">
                                <form action="/cart/remove/{{ $item->id }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm" style="background:#fff0ee;color:#dc3545;border:none;border-radius:8px;" title="Remove">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="/products" class="btn btn-outline-secondary" style="border-radius:10px;">
                <i class="fas fa-arrow-left me-2"></i>Continue Shopping
            </a>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="border-radius:16px; top:20px;">
            <div class="card-body p-4">
                <h5 class="fw-700 mb-4" style="font-weight:700;">Order Summary</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal</span>
                    <span>₹{{ number_format($total, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Shipping</span>
                    <span class="text-success fw-600">Free</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-700" style="font-weight:700;">Total</span>
                    <span class="fw-700 fs-5" style="font-weight:700;color:#ff6b35;">₹{{ number_format($total, 2) }}</span>
                </div>

                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button class="btn text-white w-100 py-3" style="background:linear-gradient(135deg,#ff6b35,#f7931e);border:none;border-radius:12px;font-weight:700;font-size:15px;">
                        <i class="fas fa-lock me-2"></i>Proceed to Checkout
                    </button>
                </form>

                <div class="d-flex justify-content-center gap-3 mt-3">
                    <i class="fas fa-shield-alt text-muted" title="Secure"></i>
                    <small class="text-muted">Secure Checkout</small>
                </div>
            </div>
        </div>
    </div>
</div>

@else

<div class="text-center py-5">
    <div class="mb-4" style="font-size:80px;opacity:0.15;">
        <i class="fas fa-shopping-cart"></i>
    </div>
    <h4 class="fw-600 mb-2" style="font-weight:600;">Your cart is empty</h4>
    <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
    <a href="/products" class="btn text-white px-5 py-2" style="background:linear-gradient(135deg,#ff6b35,#f7931e);border:none;border-radius:10px;font-weight:600;">
        <i class="fas fa-shopping-bag me-2"></i>Browse Products
    </a>
</div>

@endif

@push('scripts')
<script>
function changeQty(btn, delta) {
    const input = btn.parentElement.querySelector('input[name="quantity"]');
    const val = parseInt(input.value) + delta;
    const max = parseInt(input.max);
    if (val >= 1 && val <= max) input.value = val;
}
</script>
@endpush

@endsection
