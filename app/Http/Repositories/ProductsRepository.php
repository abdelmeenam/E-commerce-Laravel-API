<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductsInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Product;

class ProductsRepository implements ProductsInterface
{
    use ApiResponseTrait;
    public function getAllProducts(){
        $products = Product::get();
        return $this->apiResponse(200 ,'All products' ,null ,$products);
    }
}
