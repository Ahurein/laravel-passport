<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function Login(Request $request){
        try {
            if(Auth::attempt($request->only('email','password'))){
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;
                return response([
                    'message'=>'You have logged in successfully',
                    'user' => $user,
                    'token' => $token
                ], 200);
            }

        } catch(Exeption $exercep) {
            return reponse([
                'message' => $exercep->getMessage()
            ],400);
        }

        return response([
            'message'=> 'Invalid email or password'
        ],401);
    }

    public function Register(RegisterRequest $request){
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $token = $user->createToken('app')->accessToken;

            return response([
                'message' => 'Registration successful',
                'user' => $user,
                'token' => $token
            ],200);

        } catch(Exeption $e){
            return response([
                'message'=>'Registration not successful'
            ],400);
        }

        return response([
            'message'=>'Registration not successful'
        ],401);
    }
}
