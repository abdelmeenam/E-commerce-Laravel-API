<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =['name' ,'price' ,'stock' ];

    public static function rules(){
        return [
            'name'=> 'required' ,
            'price'=> 'required|min:2' ,
            'stock'=> 'required|min:2' ,
        ];
    }


}
