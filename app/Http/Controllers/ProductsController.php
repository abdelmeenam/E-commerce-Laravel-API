<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ProductsInterface;
use Illuminate\Http\Request;

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

    public function uploadProductsView(){
        return $this->productsInterface->uploadProductsView();
    }

    public function uploadProducts(Request $request){
        return $this->productsInterface->uploadProducts($request);
    }

    public function downloadProducts(){
        return $this->productsInterface->downloadProducts();
    }
}
