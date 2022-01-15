<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ForgetRequest;
use App\Mail\ForgetMail;
use App\Models\User;
use DB;
use Auth;
use Mail;

class ForgetController extends Controller
{
    public function Forget(ForgetRequest $request){
        $email = $request->email;
        if(User::where('email', $email)->doesntExist()){
            return response([
                'message'=> 'Email does not exist'
            ], 400);
        }

        $token = rand(10, 100000);

        try{
            DB::table('password_resets')->insert([
                'email'=> $email,
                'token'=> $token
            ]);

            Mail::to($email)->send(new ForgetMail($token));

            return response([
                'message'=>'Reset email sent to your email succesfully'
            ],200);

        } catch(Exeption $e){
            return response([
                'message'=> $e->getMessage()
            ],400);
        }
    }
}
