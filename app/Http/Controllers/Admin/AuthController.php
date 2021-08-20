<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $data = $this->validate($request, [
            'email'     =>'required',
            'password'  =>'required',
        ]);
        $user = User::where('email',$request->email)->first();
        if(Auth::attempt($data,true) AND $user->admin == 1){
            return redirect(aurl('dashboard'))->with('success','login success');
        }
        return redirect(aurl(''))->with('faild','login faild');
    }
}
