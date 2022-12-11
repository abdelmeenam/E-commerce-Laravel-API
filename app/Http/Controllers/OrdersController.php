<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\OrdersInterface;
use App\Http\Requests\CheckOutRequest;

class OrdersController extends Controller
{
    public $ordersInterface;
    public function __construct(OrdersInterface $ordersInterface)
    {
        $this->OrdersInterface = $ordersInterface;
    }

    public function checkOut(CheckOutRequest $request){
        return $this->OrdersInterface->checkOut($request);
    }
}
