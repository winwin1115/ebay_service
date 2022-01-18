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

    public function generateToken($id)
    {
        $random_token = Str::random(30);
        User::where(['id' => $id])->update(['use_status' => '1', 'license' => $random_token]);
        $user = User::where(['id' => $id])->first();

        // $to_email = $user['email'];
        // $user_name = $user['first_name'];
        // Mail::to($to_email)->send(new FirstEmail($random_token, 'token', $user_name));

        return redirect('/user-management');
    }

    public function deleteToken($id)
    {
        $user = User::where(['id' => $id])->update(['use_status' => '0', 'license' => '']);
        
        return redirect('/user-management');
    }
}
