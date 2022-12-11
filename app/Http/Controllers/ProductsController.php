<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ProductsInterface;

class ProductsController extends Controller
{
    public $productsInterface;
    public function __construct(ProductsInterface $productsInterface)
    {
        $this->productsInterface = $productsInterface;
    }

    public function getAllProducts(){
        return $this->productsInterface->getAllProducts();
    }
}
