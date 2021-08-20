<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function language($lang)
    {
        session()->put('lang', $lang);
        return back()->with('success','language change successful');
    }
    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }
}
