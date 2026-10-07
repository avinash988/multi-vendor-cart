@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-700 mb-1" style="font-weight:700;">
            <i class="fas fa-chart-bar me-2" style="color:#ff6b35;"></i>Admin — All Orders
        </h3>
        <p class="text-muted mb-0 small">Manage and monitor all vendor orders</p>
    </div>
    <span class="badge rounded-pill" style="background:#0f3460;font-size:13px;padding:8px 16px;">
        {{ count($orders) }} Total Orders
    </span>
</div>

{{-- Filter --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
    <div class="card-body p-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-600" style="font-weight:600;color:#555;">Vendor Name</label>
                <div class="input-group">
                    <span class="input-group-text" style="background:#f8f9fa;border:1.5px solid #e0e0e0;border-right:none;">
                        <i class="fas fa-store" style="color:#ff6b35;font-size:12px;"></i>
                    </span>
                    <input type="text" name="vendor_name" class="form-control" placeholder="Filter by vendor"
                           value="{{ request('vendor_name') }}"
                           style="border:1.5px solid #e0e0e0;border-left:none;border-radius:0 8px 8px 0;">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-600" style="font-weight:600;color:#555;">Customer Name</label>
                <div class="input-group">
                    <span class="input-group-text" style="background:#f8f9fa;border:1.5px solid #e0e0e0;border-right:none;">
                        <i class="fas fa-user" style="color:#0f3460;font-size:12px;"></i>
                    </span>
                    <input type="text" name="customer_name" class="form-control" placeholder="Filter by customer"
                           value="{{ request('customer_name') }}"
                           style="border:1.5px solid #e0e0e0;border-left:none;border-radius:0 8px 8px 0;">
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-600" style="font-weight:600;color:#555;">Status</label>
                <select name="status" class="form-select" style="border:1.5px solid #e0e0e0;border-radius:8px;">
                    <option value="">All Status</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button class="btn text-white px-4" style="background:linear-gradient(135deg,#0f3460,#1a1a2e);border:none;border-radius:8px;font-weight:600;">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
                <a href="/admin/orders" class="btn btn-outline-secondary" style="border-radius:8px;">
                    <i class="fas fa-undo me-1"></i>Reset
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Orders Table --}}
<div class="card border-0 shadow-sm" style="border-radius:16px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr style="background:#f8f9fa;">
                        <th class="px-4 py-3 border-0" style="font-size:13px;color:#666;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Order #</th>
                        <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Vendor</th>
                        <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Customer</th>
                        <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Total</th>
                        <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Payment</th>
                        <th class="py-3 border-0" style="font-size:13px;color:#666;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                <tr style="border-color:#f0f0f0;">
                    <td class="px-4 py-3 align-middle">
                        <span class="fw-600" style="font-weight:600;color:#0f3460;">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="py-3 align-middle">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:32px;height:32px;background:linear-gradient(135deg,#1a1a2e,#0f3460);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-store" style="color:rgba(255,255,255,0.5);font-size:12px;"></i>
                            </div>
                            <span class="fw-600" style="font-weight:600;">{{ $order->vendor->name }}</span>
                        </div>
                    </td>
                    <td class="py-3 align-middle">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:32px;height:32px;background:#f0f0f0;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-user" style="color:#666;font-size:12px;"></i>
                            </div>
                            {{ $order->user->name }}
                        </div>
                    </td>
                    <td class="py-3 align-middle fw-700" style="font-weight:700;color:#ff6b35;">₹{{ number_format($order->total_amount, 2) }}</td>
                    <td class="py-3 align-middle">
                        @if($order->payment->status == 'paid')
                            <span class="badge" style="background:#d4edda;color:#155724;padding:6px 12px;border-radius:20px;font-size:12px;">
                                <i class="fas fa-check-circle me-1"></i>Paid
                            </span>
                        @else
                            <span class="badge" style="background:#fff3cd;color:#856404;padding:6px 12px;border-radius:20px;font-size:12px;">
                                <i class="fas fa-clock me-1"></i>{{ ucfirst($order->payment->status) }}
                            </span>
                        @endif
                    </td>
                    <td class="py-3 align-middle">
                        <a href="/order/{{ $order->id }}" class="btn btn-sm" style="background:#e8f4fd;color:#0f3460;border:none;border-radius:8px;font-weight:600;padding:6px 14px;">
                            <i class="fas fa-eye me-1"></i>View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fs-1 mb-2 d-block" style="opacity:0.3;"></i>
                        No orders found matching your filters
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
