<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Currency;

class CurrencyController extends Controller
{
    public function getsetting(Request $request)
    {
        $currency = Currency::where(['user_id' => $request->user_id])->first();
        if($currency)
        {
            $currency_rate = $currency['currency_rate'];
            $profit_rate = $currency['profit_rate'];
        }
        else {
            $currency_rate = '';
            $profit_rate = '';
        }
        $user_info = User::where(['id' => $request->user_id])->first();
        $user_token = $user_info['user_token'];
        return response()->json(['currency_rate' => $currency_rate, 'profit_rate' => $profit_rate, 'user_token' => $user_token]);
    }
    
    public function setcurrency(Request $request)
    {
        $currency_count = Currency::where(['user_id' => $request->user_id])->first();
        if($currency_count)
        {
            $currency = Currency::where(['user_id' => $request->user_id])->update(['currency_rate' => $request->currency_rate]);
            if($currency)
                return response()->json(['status' => '200']);
            else {
                return response()->json(['status' => '500']);
            }
        }
        else {
            $currency = new Currency;
            $currency->user_id = $request->user_id;
            $currency->currency_rate = $request->currency_rate;
            if($currency->save())
                return response()->json(['status' => '200']);
            else {
                return response()->json(['status' => '500']);
            }
        }
    }

    public function setprofit(Request $request)
    {
        $profit_count = Currency::where(['user_id' => $request->user_id])->first();
        if($profit_count)
        {
            $profit = Currency::where(['user_id' => $request->user_id])->update(['profit_rate' => $request->profit_rate]);
            if($profit)
                return response()->json(['status' => '200']);
            else {
                return response()->json(['status' => '500']);
            }
        }
        else {
            $profit = new Currency;
            $profit->user_id = $request->user_id;
            $profit->profit_rate = $request->profit_rate;
            if($profit->save())
                return response()->json(['status' => '200']);
            else {
                return response()->json(['status' => '500']);
            }
        }
    }

    public function autocalc(Request $request)
    {
        $data = Currency::where(['user_id' => $request->user_id])->first();
        if($data)
        {
            $currency_rate = $data['currency_rate'];
            if(!$currency_rate)
                return response()->json(['status' => '300', 'message' => '為替レート設定をしてください！']);
            $profit_rate = $data['profit_rate'];
            if(!$profit_rate)
                return response()->json(['status' => '300', 'message' => 'eBay販売設定をしてください！']);
            $real_price = $request->price / $currency_rate * $profit_rate;
            return response()->json(['status' => '200', 'data' => $real_price]);
        }
        else {
            return response()->json(['status' => '300', 'message' => '各種設定をしてください！']);
        }
    }
}
