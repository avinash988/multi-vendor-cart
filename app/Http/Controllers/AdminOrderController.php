<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with([
            'vendor',
            'user',
            'payment'
        ]);

        if ($request->vendor_name) {

            $orders->whereHas('vendor', function ($query) use ($request) {

                $query->where(
                    'name',
                    'like',
                    '%' . $request->vendor_name . '%'
                );

            });
        }

        if ($request->customer_name) {

            $orders->whereHas('user', function ($query) use ($request) {

                $query->where(
                    'name',
                    'like',
                    '%' . $request->customer_name . '%'
                );

            });
        }

        if ($request->status) {

            $orders->where(
                'status',
                $request->status
            );
        }

        $orders = $orders->get();

        return view(
            'admin.orders',
            compact('orders')
        );
    }
}