<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Http\Request;

use Livewire\Component;
use App\Models\User;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember_me = false;

    // protected $rules = [
    //     'email' => 'required|email:rfc,dns',
    //     'password' => 'required',
    // ];

    public function mount() {
        if(auth()->user()){
            if (auth()->user()->user_type == '9') {
                redirect('/user-management');    
            }
            else {
                redirect('/my-profile');
            }
        }
        // $this->fill(['email' => 'admin@softui.com', 'password' => 'secret']);
    }

    public function login(Request $request) {
        $user = User::where(["email" => $request->email])->first();
        if(!$user)
            return redirect()->back()->with('credent', '登録されていないユーザーです。');
        // elseif(!$user['license'])
        //     return redirect()->back()->with('license', 'まだ許可されていないユーザーです。');
        // elseif ($user['license'] != $request->license) {
        //     return redirect()->back()->with('license', 'ライセンスが正しくありません。');
        // }

        $from_date = strtotime($user->created_at);
        $now = strtotime(now());
        $days = ($now - $from_date) / 86400;
        if($days > 365)
            return redirect()->back()->with('license', '使用期間が切れました。');

        if(auth()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember_me)) {
            auth()->login($user, $request->remember_me);
            if(auth()->user()->user_type == '9')
                return redirect()->intended('/user-management');
            else {
                return redirect()->intended('/my-profile');
            }
        }
        else{
            return redirect()->back()->with('credent', 'ログイン情報が正しくありません。');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
