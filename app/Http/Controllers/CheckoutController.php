<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;

class CheckoutController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function checkout()
    {
        try {

            $this->checkoutService
                ->checkout(session('user_id'));

            return redirect()
                ->route('products')
                ->with(
                    'success',
                    'Order placed successfully'
                );

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withErrors(
                    $e->getMessage()
                );
        }
    }
}