@extends('layouts.app')

@section('content')

<div class="mb-4">
    <h3 class="fw-700 mb-1" style="font-weight:700;">
        <i class="fas fa-box me-2" style="color:#ff6b35;"></i>My Orders
    </h3>
    <p class="text-muted mb-0 small">Track and manage all your orders</p>
</div>

@if(count($orders))

<div class="card border-0 shadow-sm" style="border-radius:16px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr style="background:#f8f9fa;">
                        <th class="px-4 py-3 border-0" style="font-size:13px;color:#666;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Order #</th>
                        <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Vendor</th>
                        <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Total</th>
                        <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Status</th>
                        <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                <tr style="border-color:#f0f0f0;">
                    <td class="px-4 py-3 align-middle">
                        <span class="fw-600" style="font-weight:600;color:#0f3460;">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="py-3 align-middle">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:32px;height:32px;background:linear-gradient(135deg,#1a1a2e,#0f3460);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-store" style="color:rgba(255,255,255,0.5);font-size:13px;"></i>
                            </div>
                            <span>{{ $order->vendor->name }}</span>
                        </div>
                    </td>
                    <td class="py-3 align-middle fw-700" style="font-weight:700;color:#ff6b35;">₹{{ number_format($order->total_amount, 2) }}</td>
                    <td class="py-3 align-middle">
                        @if($order->status == 'paid')
                            <span class="badge" style="background:#d4edda;color:#155724;padding:6px 12px;border-radius:20px;font-size:12px;">
                                <i class="fas fa-check-circle me-1"></i>Paid
                            </span>
                        @elseif($order->status == 'pending')
                            <span class="badge" style="background:#fff3cd;color:#856404;padding:6px 12px;border-radius:20px;font-size:12px;">
                                <i class="fas fa-clock me-1"></i>Pending
                            </span>
                        @else
                            <span class="badge" style="background:#f8d7da;color:#721c24;padding:6px 12px;border-radius:20px;font-size:12px;">
                                <i class="fas fa-times-circle me-1"></i>{{ ucfirst($order->status) }}
                            </span>
                        @endif
                    </td>
                    <td class="py-3 align-middle">
                        <a href="/order/{{ $order->id }}" class="btn btn-sm" style="background:#e8f4fd;color:#0f3460;border:none;border-radius:8px;font-weight:600;padding:6px 14px;">
                            <i class="fas fa-eye me-1"></i>View Details
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@else

<div class="text-center py-5">
    <div class="mb-4" style="font-size:80px;opacity:0.1;">
        <i class="fas fa-box-open"></i>
    </div>
    <h4 class="fw-600 mb-2" style="font-weight:600;">No Orders Yet</h4>
    <p class="text-muted mb-4">You haven't placed any orders yet.</p>
    <a href="/products" class="btn text-white px-5 py-2" style="background:linear-gradient(135deg,#ff6b35,#f7931e);border:none;border-radius:10px;font-weight:600;">
        <i class="fas fa-shopping-bag me-2"></i>Start Shopping
    </a>
</div>

@endif

@endsection
