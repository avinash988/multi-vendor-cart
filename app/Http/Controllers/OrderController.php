<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function myOrders()
    {
        $orders = Order::with([
            'vendor',
            'payment'
        ])
        ->where('user_id', session('user_id'))
        ->latest()
        ->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with([
            'vendor',
            'user',
            'payment',
            'items.product'
        ])->findOrFail($id);

        if (
            session('user_role') != 'admin'
            &&
            $order->user_id != session('user_id')
        ) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }
}