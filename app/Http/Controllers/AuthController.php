<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\AuthInterface;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public $authInterface;
    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }

    public function Register(Request $request){
        return  $this->authInterface->Register($request);
    }

    public function Login(Request $request){
        return  $this->authInterface->Login($request);
    }


}

