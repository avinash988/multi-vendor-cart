@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="/my-orders" class="btn btn-sm btn-outline-secondary mb-2" style="border-radius:8px;">
            <i class="fas fa-arrow-left me-1"></i>Back to Orders
        </a>
        <h3 class="fw-700 mb-1" style="font-weight:700;">
            Order <span style="color:#ff6b35;">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
        </h3>
    </div>
    @if($order->status == 'paid')
        <span class="badge" style="background:#d4edda;color:#155724;padding:10px 20px;border-radius:20px;font-size:14px;">
            <i class="fas fa-check-circle me-1"></i>Paid
        </span>
    @elseif($order->status == 'pending')
        <span class="badge" style="background:#fff3cd;color:#856404;padding:10px 20px;border-radius:20px;font-size:14px;">
            <i class="fas fa-clock me-1"></i>Pending
        </span>
    @else
        <span class="badge" style="background:#f8d7da;color:#721c24;padding:10px 20px;border-radius:20px;font-size:14px;">
            <i class="fas fa-times-circle me-1"></i>{{ ucfirst($order->status) }}
        </span>
    @endif
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100" style="border-radius:16px;">
            <div class="card-body p-4">
                <h6 class="text-uppercase mb-3" style="font-size:12px;letter-spacing:1px;color:#999;font-weight:600;">Order Details</h6>

                <div class="d-flex align-items-start mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                    <div style="width:38px;height:38px;background:#e8f4fd;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-user" style="color:#0f3460;font-size:16px;"></i>
                    </div>
                    <div class="ms-3">
                        <div class="text-muted" style="font-size:12px;">Customer</div>
                        <div class="fw-600" style="font-weight:600;">{{ $order->user->name }}</div>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-3 pb-3" style="border-bottom:1px solid #f0f0f0;">
                    <div style="width:38px;height:38px;background:#fff0ee;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-store" style="color:#ff6b35;font-size:16px;"></i>
                    </div>
                    <div class="ms-3">
                        <div class="text-muted" style="font-size:12px;">Vendor</div>
                        <div class="fw-600" style="font-weight:600;">{{ $order->vendor->name }}</div>
                    </div>
                </div>

                <div class="d-flex align-items-start">
                    <div style="width:38px;height:38px;background:#d4edda;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-rupee-sign" style="color:#155724;font-size:16px;"></i>
                    </div>
                    <div class="ms-3">
                        <div class="text-muted" style="font-size:12px;">Total Amount</div>
                        <div class="fw-700 fs-5" style="font-weight:700;color:#ff6b35;">₹{{ number_format($order->total_amount, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-body p-0">
                <div class="px-4 py-3" style="border-bottom:1px solid #f0f0f0;">
                    <h6 class="mb-0 fw-600" style="font-weight:600;">
                        <i class="fas fa-list me-2" style="color:#ff6b35;"></i>Order Items
                    </h6>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr style="background:#f8f9fa;">
                                <th class="px-4 py-3 border-0" style="font-size:13px;color:#666;font-weight:600;">Product</th>
                                <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;">Qty</th>
                                <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;">Unit Price</th>
                                <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($order->items as $item)
                        <tr style="border-color:#f0f0f0;">
                            <td class="px-4 py-3 align-middle">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width:40px;height:40px;background:linear-gradient(135deg,#1a1a2e,#0f3460);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-box" style="color:rgba(255,255,255,0.4);font-size:16px;"></i>
                                    </div>
                                    <span class="fw-600" style="font-weight:600;">{{ $item->product->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 align-middle">
                                <span class="badge rounded-pill" style="background:#e8f4fd;color:#0f3460;padding:5px 12px;">× {{ $item->quantity }}</span>
                            </td>
                            <td class="py-3 align-middle text-muted">₹{{ number_format($item->price, 2) }}</td>
                            <td class="py-3 align-middle fw-700" style="font-weight:700;color:#1a1a2e;">₹{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background:#f8f9fa;">
                                <td colspan="3" class="px-4 py-3 text-end fw-700" style="font-weight:700;border:none;">Grand Total:</td>
                                <td class="py-3 fw-700 fs-5" style="font-weight:700;color:#ff6b35;border:none;">₹{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
