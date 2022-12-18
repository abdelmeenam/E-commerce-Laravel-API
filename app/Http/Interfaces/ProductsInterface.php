<?php

namespace App\Http\Interfaces;
interface ProductsInterface
{
    public function getAllProducts();
    public function uploadProductsView();
    public function uploadProducts($request);
    public function downloadProducts();
    }
