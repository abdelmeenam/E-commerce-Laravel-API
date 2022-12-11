<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthRepository implements AuthInterface
{
    use ApiResponseTrait;
    public function Register($request){

        $validation = Validator::make($request->all() , [
            'name' => 'required' ,
            'email' => 'required' ,
            'password' => 'required' ,
        ]);

        if ($validation->fails()){
            return $this->apiResponse(400 ,'validation error' , $validation->errors());
        }

        User::create([
            'name'=>$request->name ,
            'email'=>$request->email ,
            'password'=> Hash::make($request->password ),
        ]);
       return $this->apiResponse(200 ,'Account was created' );
    }

    public function Login($request)
    {
        $validation = Validator::make($request->all() , [
            'email' => 'required' ,
            'password' => 'required' ,
        ]);
        if ($validation->fails()){
            return $this->apiResponse(400 ,'validation error' , $validation->errors());
        }

        $credentials = request(['email', 'password']);
        //$credentials = request()->only('email' , 'password');
        if (! $token = auth()->attempt($credentials)) {
            return $this->apiResponse(400 , 'Unauthorized');
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $array = [
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL() * 60
        ];
        return $this->apiResponse(200 , 'logged In', null , $array);
    }

}
