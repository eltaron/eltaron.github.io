<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ads;
use App\Models\Blog;
use App\Models\Chat;
use App\Models\Contact;
class HomeController extends Controller
{
    public function index(){
        if(Auth::user()->agent == 1) {
            $latestblogs = Blog::where('user_id',Auth::user()->id)->where('status',1)->orderby('id','DESC')->take(6)->get();
            $latestads = Ads::where('user_id',Auth::user()->id)->where('status',1)->orderby('id','DESC')->take(6)->get();
            return view('agent.home.index')->with([
                'ads'=>Ads::where('user_id',Auth::user()->id)->count(),
                'blogs'=>Blog::where('user_id',Auth::user()->id)->count(),
                'chats'=>Chat::where('agent_id',Auth::user()->id)->count(),
                'messages'=>Contact::where('user_id',Auth::user()->id)->count(),
                'latestblogs'=>$latestblogs,
                'latestads'=>$latestads,
            ]);
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function home(){
        if(Auth::user()->agent == 1) {
            $latestblogs = Blog::where('status',1)->orderby('id','DESC')->take(6)->get();
            $latestads = Ads::where('status',1)->orderby('id','DESC')->take(6)->get();
            return view('agent.home.index')->with([
                'ads'=>Ads::count(),
                'blogs'=>Blog::count(),
                'chats'=>Chat::count(),
                'messages'=>Contact::count(),
                'latestblogs'=>$latestblogs,
                'latestads'=>$latestads,
            ]);
        } else {
            return redirect(url('user/dashboard'));
        }
    }
}
