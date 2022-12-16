<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CartInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Cart;
use App\Rules\CartValidatdion;
use App\Rules\StockValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartRepository implements CartInterface
{
    use ApiResponseTrait;

    public function addToCart($request)
    {

        $validations = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'count'    => ['required', new StockValidation($request->product_id)]
        ]);
        if ($validations->fails()) {
            return $this->apiResponse(400, 'validation errors', $validations->errors());
        }
        //User may be add the same product ,so we only have to update the count
        $cart = Cart::where([['user_id', '=', Auth::user()->id], ['product_id', '=', $request->product_id]])->first();
        if ($cart) {
            $cart->update([
                'count' => $cart->count + $request->count
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
                'count' => $request->count
            ]);
        }
        return  $this->apiResponse(200, 'added to cart');
    }

    public function updateCart($request)
    {

        $validations = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'count' => ['required', new CartValidatdion($request->product_id)]
        ]);
        if ($validations->fails()) {
            return $this->apiResponse(400, 'validation errors', $validations->errors());
        }

        $cart = Cart::where([['user_id', Auth::user()->id], ['product_id', $request->product_id]])->first();

        $cart->update([
            'count' => $request->count
        ]);

        return  $this->apiResponse(200, 'Cart Updated');
    }

    public function deleteFromCart($request)
    {
        $cart = Cart::find($request->cart_id);
        if ($cart) {
            $cart->delete();
            return  $this->apiResponse(200, 'Deleted from cart');
        }
        return $this->apiResponse(400, 'Cart not found');
    }

    public function userCart()
    {
        $carts = Cart::where('user_id', '=', Auth::user()->id)->get();
        return  $this->apiResponse(200, 'All products of your cart ', null, $carts);
    }
}