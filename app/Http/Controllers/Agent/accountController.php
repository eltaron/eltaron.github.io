<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\AgentAccount;
use App\Models\Blog;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class accountController extends Controller
{
    public function index(){
        if(Auth::user()->agent == 1) {
            $agent = AgentAccount::where('user_id',Auth::user()->id)->first();
            $ads = Ads::where('user_id',Auth::user()->id)->get();
            $blogs = Blog::where('user_id',Auth::user()->id)->get();
            return view('agent.account.index')->with([
                'title'=>trans('web.Account'),
                'agent'=>$agent,
                'ads'=>$ads,
                'blogs'=>$blogs,
                'cities'=>City::all()
            ]);
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function update_image(Request $request){
        if(Auth::user()->agent == 1) {
            $request->validate([
                'image'    =>  'required',
            ], [], [
                'image'    => trans('web.Image'),
            ]);
            $agent = User::where('id',Auth::user()->id)->first();
            $mainpath = date("Y-m-d").'/';
            $file = $request->file('image');
            if (isset($file)){
                $fileNameWithExtension = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $imageName = $fileName.'_'.time().'.'.$extension;
                $path = $file->move(public_path('storage/logos/'.$mainpath), $imageName);
                $agent->image = url('').'/storage/logos/'.$mainpath.$imageName;
                $agent->save();
                return back()->with('success','Image Updated');
            }
            return back()->with('faild','An error occured');
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function edit(Request $request){
        if(Auth::user()->agent == 1) {
            $agent = AgentAccount::where('user_id',Auth::user()->id)->first();
            $user  = User::where('id',Auth::user()->id)->first();
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->city_id      = $request->city;
            $user->description  = $request->description;
            $user->save();
            $agent->facebook    = $request->facebook;
            $agent->twitter     = $request->twitter;
            $agent->instgram    = $request->instgram;
            $agent->save();
            return back()->with('success','User Updated');
        } else {
            return redirect(url('user/dashboard'));
        }
    }
}
