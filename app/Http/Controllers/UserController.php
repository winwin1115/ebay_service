<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $check_user = User::where(['email' => $request->email])->get();
        if(count($check_user))
            return response()->json(['status' => '300']);
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->password = $request->password;
        $user->user_type = '0';
        if($user->save())
            return response()->json(['status' => '200']);
        else {
            return response()->json(['status' => '500']);
        }
    }

    public function login(Request $request)
    {
        if (User::login($request)) {
            $user = User::where(['email' => $request->email, 'user_type' => '0'])->get();
            return response()->json(['status' => '200', 'data' => $user]);
        }
        
        return response()->json(['status' => '500']);
    }

    public function settoken(Request $request)
    {
        $user = User::where(['id' => $request->user_id])->update(['user_token' => $request->user_token]);
        if($user)
            return response()->json(['status' => '200']);
        else {
            return response()->json(['status' => '500']);
        }
    }
}
