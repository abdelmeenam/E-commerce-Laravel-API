<?php

namespace App\Rules;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StockValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $product_id;
    public function __construct($product_id)
    {
        $this->product_id = $product_id;
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
        //Don't user first() because it returns collection and we need True or false as return data. [use ->exists()]
        //$this->product_id or request('product_id').
        $product = Product::where( [['id' , '=' ,$this->product_id] , ['stock' , '>=' , $value ] ])->first();
        if ($product){
            //check if DB has the same query(same user+same product)
            $cart =Cart::where([ ['user_id' , '=' ,Auth::user()->id  ] , ['product_id' , '=' , $product->id ]])->first();
                if ($cart){
                    $count = $cart->count + $value;
                    if ($count <= $product->stock ){
                        return true;            //The 2nd Addition
                    }
                    return false;
                }
            return true;            //The first Addition
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Out of stock';
    }
}
