<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Services\CartService;
use App\Http\Requests\AddToCartRequest;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function add(AddToCartRequest $request)
    {
        try {
            $product = Product::findOrFail(
                $request->product_id
            );

            if ($request->quantity > $product->stock) {

                return redirect()->back()
                    ->withErrors(
                        'Requested quantity exceeds available stock.'
                    );
            }

            $this->cartService->addToCart(
                session('user_id'),
                $request->product_id,
                $request->quantity
            );

            return redirect()->back()
                ->with('success', 'Product added to cart');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }

    public function index()
    {
        $cart = $this->cartService->getCart(
            session('user_id')
        );

        return view(
            'cart.index',
            compact('cart')
        );
    }

    public function update($id, \Illuminate\Http\Request $request)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cartItem = CartItem::findOrFail($id);

        $product = $cartItem->product;

        if ($request->quantity > $product->stock) {
            return redirect()->back()
                ->withErrors('Quantity exceeds available stock (' . $product->stock . ').');
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->back()->with('success', 'Cart updated.');
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);

        $cartItem->delete();

        return redirect()->back()
            ->with(
                'success',
                'Item removed from cart'
            );
    }
}