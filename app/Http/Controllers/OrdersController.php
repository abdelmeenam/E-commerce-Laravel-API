<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\OrdersInterface;
use App\Http\Requests\CheckOutRequest;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public $ordersInterface;
    public function __construct(OrdersInterface $ordersInterface)
    {
        $this->OrdersInterface = $ordersInterface;
    }

    public function checkOut(Request $request){
        return $this->OrdersInterface->checkOut($request);
    }
}
