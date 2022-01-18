<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetRequest;
use App\Models\User;
use DB;
use Auth;

class ResetController extends Controller
{
    public function Reset(ResetRequest $request){
        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);

        $email_check = DB::table('users')->where('email', $email)->first();
        $token_check = DB::table('password_resets')->where('token', $token)->first();

        if(!$email_check){
            return response([
                'message' => 'Invalid email',
            ], 401);
        }

        if(!$token_check){
            return response([
                'message' => 'Invalid token',
            ], 401);
        }

        DB::table('users')->where('email', $email)->update([
            'password' => $password
        ],200);

        return response([
            'message' => 'password updated successfully',
        ], 401);

        DB::table('password_resets')->where('token', $token)->delete();
        
    }
}
