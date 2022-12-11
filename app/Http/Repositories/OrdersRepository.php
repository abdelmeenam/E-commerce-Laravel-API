<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\OrdersInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrdersRepository implements OrdersInterface
{
    use ApiResponseTrait;
    public function checkOut($request){
        $cartItems = Cart::where('user_id' , auth()->user()->id)->with('product')->get();
        $totalPrice =0;
        //$totalPrice += $cartItem->count * $cartItem->product->price;

        DB::transaction(function() use ($totalPrice , $cartItems){
            $order = Order::create([
                'user_id' => auth()->user()->id ,
                'total_price' => $totalPrice
            ]);

            foreach ($cartItems as $cartItem){
                OrderItem::create([
                    'order_id' =>  $order->id,
                    'product_id' => $cartItem->product->id ,
                    'count' => $cartItem->count ,
                    'unit_price'=> $cartItem->product->price ,
                    'net_price' => $cartItem->count * $cartItem->product->price
                ]);
            }
        });
        return  $this->apiResponse(200 , 'Order was created');
    }
}
