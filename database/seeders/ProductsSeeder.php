<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products =[
            ['product' ,100 ,3] ,
            ['product' ,100 ,3] ,
            ['product' ,100 ,3] ,
            ['product' ,100 ,3] ,
            ['product' ,100 ,3] ,
            ['product' ,100 ,3] ,
            ['product' ,100 ,3] ,
            ['product' ,100 ,3] ,
            ['product' ,100 ,3] ,
            ['product' ,100 ,3] ,
        ];

    foreach ($products as $product){
        Product::create([
           'name' => $product[0],
           'price' => $product[1],
           'stock' => $product[2],
        ]);
    }

    }
}
