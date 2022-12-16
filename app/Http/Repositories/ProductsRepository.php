<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductsInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Product;
use http\Env\Request;

class ProductsRepository implements ProductsInterface
{
    use ApiResponseTrait;
    public function getAllProducts()
    {
        $products = Product::get();
        if (count($products) == 0) {
            return $this->apiResponse(400, 'Don\'t have enough products in our store');
        }
        return $this->apiResponse(200, 'All products', null, $products);
    }

    public function export(){

    }

    public function import(Request $request){

    }

}
