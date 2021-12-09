<?php

namespace App\Http\Livewire\LaravelExamples;
use App\Models\User;

use Livewire\Component;

use Illuminate\Http\Request;

class UserProfile extends Component
{
    // public $user;
    // public $showSuccesNotification  = false;

    // public $showDemoNotification = false;
    
    // protected $rules = [
    //     'user.name' => 'max:40|min:3',
    //     'user.email' => 'email:rfc,dns',
    //     'user.phone' => 'max:10',
    //     'user.about' => 'max:200',
    //     'user.location' => 'min:3'
    // ];

    // public function mount() { 
    //     $this->user = auth()->user();
    // }

    public function updateProfile(Request $request) {
        $user = User::where(['id' => auth()->user()->id])->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ]);

        return redirect('/my-profile');
    }

    // public function userProfile($id)
    // {
    //     $user_info = User::where(['id' => $id])->first();
    //     return view('livewire.laravel-examples.user-profile')->with(['user_info' => $user_info]);
    // }

    public function render()
    {
        $user_info = auth()->user();
        return view('livewire.laravel-examples.user-profile')->with(['user_info' => $user_info]);
    }
}
