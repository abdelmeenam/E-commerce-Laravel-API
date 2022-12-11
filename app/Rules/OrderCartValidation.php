<?php

namespace App\Rules;

use App\Models\Cart;
use Illuminate\Contracts\Validation\Rule;

class OrderCartValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $cartItems = Cart::where('user_id' , auth()->user()->id)->with('product')->get();
        foreach ($cartItems as $cartItem){
            if ($cartItem->product->stock <=  $cartItem->count){
                return  false;
            }
        }
        return true;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Order failed!!...Selected product is out of stock';
    }
}
