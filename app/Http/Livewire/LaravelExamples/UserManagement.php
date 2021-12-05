<?php

namespace App\Http\Livewire\LaravelExamples;

use Livewire\Component;

use App\Models\User;

class UserManagement extends Component
{
    public function render()
    {
        $user = User::where('user_type', '!=', '9')->get();
        return view('livewire.laravel-examples.user-management')->with(['user_info' => $user]);
    }
}
