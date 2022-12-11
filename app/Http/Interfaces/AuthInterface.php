<?php

namespace App\Http\Interfaces;
interface AuthInterface
{
    public function Register($request);
    public function Login($request);

}
