<?php

namespace App\Http\Livewire\LaravelExamples;

use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Mail\FirstEmail;

class UserManagement extends Component
{
    public function render()
    {
        $user = User::where('user_type', '!=', '9')->get();
        return view('livewire.laravel-examples.user-management')->with(['user_info' => $user]);
    }

    public function generateToken(Request $request)
    {
        $random_token = Str::random(30);
        $user = User::where(['id' => $request->user_id])->update(['use_status' => '1', 'license' => $random_token]);

        $to_email = $user['email'];
        $user_name = $user['first_name'];
        Mail::to($to_email)->send(new FirstEmail($random_token, 'token', $user_name));

        if($user)
            return response()->json(['status' => '200']);
        else {
            return response()->json(['status' => '500']);
        }
    }

    public function deleteToken(Request $request)
    {
        $user = User::where(['id' => $request->user_id])->update(['use_status' => '0', 'license' => '']);
        if($user)
            return response()->json(['status' => '200']);
        else {
            return response()->json(['status' => '500']);
        }
    }
}
