<?php

namespace App\Http\Repositories;

use App\Exports\ProductExport;
use App\Http\Interfaces\ProductsInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Imports\ProductImport;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;

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

    public function  uploadProductsView(){
        return view('products');
    }

    public function uploadProducts($request){
        Excel::import(new ProductImport , $request->file);
        return redirect('/products')->with('success', 'All good!');
    }

    public function downloadProducts(){
        return Excel::download(new ProductExport(), 'test.xlsx');

    }

}
