<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SignUp extends Component
{
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $password = '';

    // protected $rules = [
    //     'first_name' => 'required|min:3',
    //     'last_name' => 'required|min:3',
    //     'email' => 'required|email:rfc,dns|unique:users',
    //     'password' => 'required|min:6|same:confirm_password',
    //     'confirm_password' => 'min:6'
    // ];

    // public function mount() {
    //     if(auth()->user()){
    //         redirect('/dashboard');
    //     }
    // }

    public function register(Request $request) {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => $request->password,
            'user_type' => '0'
        ]);
        
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.auth.sign-up');
    }
}
