<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Blog;
use App\Models\Chat;
use App\Models\Contact;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(!Auth::guest()){
            return redirect(url(''));
        } else {
            return view('admin.auth.login') ;
        }
    }
    public function dashboard(){
        if(!Auth::guest()){
            if(Auth::user()->admin == 1){
                $latestblogs = Blog::where('status',1)->orderby('id','DESC')->take(6)->get();
                $latestads = Ads::where('status',1)->orderby('id','DESC')->take(6)->get();
                return view('admin.dashboard.index')->with([
                    'ads'=>Ads::count(),
                    'blogs'=>Blog::count(),
                    'chats'=>Chat::count(),
                    'messages'=>Contact::count(),
                    'latestblogs'=>$latestblogs,
                    'latestads'=>$latestads,
                ]);
            } else {
                return redirect(aurl('/'));
            }
        } else {
            return view('admin.auth.login') ;
        }
    }
}
