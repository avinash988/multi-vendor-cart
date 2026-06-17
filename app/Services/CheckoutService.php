<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Events\OrderPlaced;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    public function checkout($userId)
    {
        DB::beginTransaction();

        try {

            $cart = Cart::with('items.product.vendor')
                ->where('user_id', $userId)
                ->first();

            if (!$cart || $cart->items->count() == 0) {
                throw new \Exception('Cart is empty');
            }

            $groupedItems = $cart->items->groupBy(function ($item) {
                return $item->product->vendor_id;
            });

            foreach ($groupedItems as $vendorId => $items) {

                $totalAmount = 0;

                /*
                 * Stock Validation
                 */
                foreach ($items as $item) {

                    if ($item->quantity > $item->product->stock) {

                        throw new \Exception(
                            $item->product->name . ' stock not available'
                        );
                    }

                    $totalAmount += (
                        $item->product->price * $item->quantity
                    );
                }

                $order = Order::create([
                    'user_id'      => $userId,
                    'vendor_id'    => $vendorId,
                    'total_amount' => $totalAmount,
                    'status'       => 'paid'
                ]);

                foreach ($items as $item) {

                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $item->product_id,
                        'quantity'   => $item->quantity,
                        'price'      => $item->product->price
                    ]);

                    /*
                     * Reduce Stock
                     */
                    $item->product->decrement(
                        'stock',
                        $item->quantity
                    );
                }

                Payment::create([
                    'order_id' => $order->id,
                    'amount'   => $totalAmount,
                    'status'   => 'paid'
                ]);

                event(
                    new OrderPlaced($order)
                );
            }

            $cart->items()->delete();

            DB::commit();

            return true;

        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }
}