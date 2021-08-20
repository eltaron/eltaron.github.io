<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\deelmy;
use App\Models\User;
use App\Models\AgentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public function login(){
        if(!Auth::guest()){
            return redirect(url(''));
        } else {
            return view('web.auth.login');
        }
    }
    public function log(Request $request){
        if(!Auth::guest()){
            return redirect(url(''));
        } else {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' =>  ['required', 'string', 'min:6'],
            ]);
            $user = User::where('email',$request->email)->latest()->first();
            if (Auth::attempt(['email' => $request->email , 'password' => $request->password])) {
                if(session()->has('previous-url')){
                    return redirect(session('previous-url'))->with('login success');
                }else{
                    if($user->agent == 1){
                        return redirect(gurl(''))->with('success','login success');
                    } elseif($user->agent == 0) {
                        return redirect(url('user/dashboard'))->with('success','login success');
                    }
                }
            }
            return back()->with('faild','please check your data');
        }
    }
    public function register(){
        if(!Auth::guest()){
            return redirect(url(''));
        } else {
            return view('web.auth.register');
        }
    }
    public function store(Request $request)
    {
        if(!Auth::guest()){
            return redirect(url(''));
        } else {
            $request->validate([
                'name'          =>  ['required', 'string', 'max:255'],
                'email'         =>  ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'      =>  ['required', 'string', 'min:6'],
                'password2'     =>  ['required', 'string', 'min:6'],
                'options'       => 'required',
            ], [], [
                'name'          => trans('web.User Name'),
                'email'         => trans('web.Email'),
                'password'      => trans('web.Enter Password'),
                'password2'     => trans('web.Confirm Password'),
                'options'       => trans('web.Choose Agent Or User'),
            ]);
            if ($request->options == 2) {
                if($request->password == $request->password2) {
                    $user = new User();
                    $user->name     = $request->name;
                    $user->email    = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->status   = 1;
                    $user->save();
                    Auth::login($user);
                    if(session()->has('previous-url')){
                        return redirect(session('previous-url'))->with('Register Successful');
                    }else{
                        return redirect(url('user/dashboard'))->with('success','Register Successful');
                    }
                }else {
                    return redirect(url('register'))->with('faild','password dont match');
                }
            } elseif ($request->options == 1) {
                if($request->password == $request->password2) {
                    $user = new User();
                    $user->name     = $request->name;
                    $user->email    = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->status   = 1;
                    $user->agent    = 1;
                    $user->save();
                    $AgentAccount = new AgentAccount();
                    $AgentAccount->user_id     = $user->id;
                    $AgentAccount->status   = 1;
                    $AgentAccount->save();
                    if($user){
                        Auth::login($user);
                        if(session()->has('previous-url')){
                            return redirect(session('previous-url'))->with('Register Successful');
                        }else{
                            return redirect(gurl(''))->with('success','Register Successful');
                        }
                    }
                } else {
                    return redirect(url('register'))->with('faild','password dont match');
                }
            }
            return redirect(url('register'))->with('faild','Register falid');
        }
    }
    public function forgetPassword(){
        if(!Auth::guest()){
            return redirect(url(''));
        } else {
            return view('web.auth.forgetPassword');
        }
    }
    public function forget(Request $request){
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $user = User::where('email',$request->email)->latest()->first();
        if($user) {
            $data = [
                'title'=>trans('web.Reset Password'),
                'body'=>trans('web.please follow this link to reset your password'),
                'link'=>url('resetPassword/'.$request->email)
            ];
            Mail::to($request->email)->send(new deelmy($data));
            return back()->with('success','Reset Password Link Has Been Sent Successful');
        } else {
            return back()->with('faild','Email Not Found');
        }
    }
    public function resetPassword($email){
        if(!Auth::guest()){
            return redirect(url(''));
        } else {
            return view('web.auth.resetPassword')->with('email',$email);
        }
    }
    public function reset(Request $request){
        $request->validate([
            'password'      => ['required', 'string', 'min:6'],
            'password2'     => ['required', 'string', 'min:6'],
        ], [], [
            'password'      => trans('web.Enter Password'),
            'password2'     => trans('web.Confirm Password'),
        ]);
        if($request->password == $request->password2) {
            $user = User::where('email',$request->email)->latest()->first();
            $user->password = Hash::make($request->password);
            $user->save();
            if (Auth::attempt(['email' => $request->email , 'password' => $request->password])) {
                if(session()->has('previous-url')){
                    return redirect(session('previous-url'))->with('login success');
                }else{
                    if($user->agent == 1){
                        return redirect(gurl(''))->with('success','login success');
                    } elseif($user->agent == 0) {
                        return redirect(url('user/dashboard'))->with('success','login success');
                    }
                }
            }
        } else {
            return back()->with('faild','password dont match');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }
}
