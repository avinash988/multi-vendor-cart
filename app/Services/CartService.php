<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;

class CartService
{
    public function addToCart($userId, $productId, $quantity)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => $userId
        ]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        $product = \App\Models\Product::findOrFail($productId);

        if ($cartItem) {

            $newQuantity = $cartItem->quantity + $quantity;

            if ($newQuantity > $product->stock) {
                throw new \Exception(
                    'Requested quantity exceeds available stock.'
                );
            }

            $cartItem->quantity = $newQuantity;

            $cartItem->save();

        } else {

            if ($quantity > $product->stock) {
                throw new \Exception(
                    'Requested quantity exceeds available stock.'
                );
            }

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        return true;
    }

    public function removeItem($cartItemId)
    {
        CartItem::findOrFail($cartItemId)->delete();

        return true;
    }

    public function getCart($userId)
    {
        return Cart::with('items.product.vendor')
            ->where('user_id', $userId)
            ->first();
    }
}