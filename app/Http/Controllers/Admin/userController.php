<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentAccount;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function index(){
        if(Auth::user()->admin == 1){
        $user = User::where('agent', 0)->get();
        return view('admin.user.index')->with([
            'title'=>trans('web.Users'),
            'users'=>$user,
            ]);
        } else {
            return redirect(url('/'));
        }
    }
    public function delete(Request $request){
        if(Auth::user()->admin == 1) {
            $user = User::where('id' , $request->user_id)->first();
            if($user){
                $user->delete();
                return back()->with('success','User Deleted');
            } else {
                return back()->with('faild','user Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function disactivate(Request $request){
        if(Auth::user()->admin == 1) {
            $user = User::where('id' , $request->user_id)->first();
            if($user){
                $user->status = 0;
                $user->save();
                return back()->with('success','User Updated');
            } else {
                return back()->with('faild','user Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function activate(Request $request){
        if(Auth::user()->admin == 1) {
            $user = User::where('id' , $request->user_id)->first();
            if($user){
                $user->status = 1;
                $user->save();
                return back()->with('success','User Updated');
            } else {
                return back()->with('faild','user Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function agent(){
        if(Auth::user()->admin == 1){
        $user = User::where('agent' , 1)->get();
        return view('admin.user.agent')->with([
            'title'=>trans('web.Agents'),
            'users'=>$user,
        ]);
        } else {
            return redirect(url('/'));
        }
    }
    public function show($id){
        if(Auth::user()->admin == 1) {
            $user = User::where('id',$id)->first();
            $agent = AgentAccount::where('user_id',$id)->first();
            return view('admin.user.account')->with([
                'title'=>trans('web.Account'),
                'user'=>$user,
                'agent'=>$agent,
                'cities'=>City::all()
            ]);
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function edit_image_back(Request $request){
        if(Auth::user()->admin == 1) {
            $request->validate([
                'image'    =>  'required',
            ], [], [
                'image'    => trans('web.Image'),
            ]);
            $agent = User::where('id',$request->user_id)->first();
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
    public function edit_back(Request $request){
        if(Auth::user()->admin == 1) {
            $agent = AgentAccount::where('user_id',$request->user_id)->first();
            $user  = User::where('id',$request->user_id)->first();
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->city_id      = $request->city;
            $user->description  = $request->description;
            $user->save();
            if($agent){
                $agent->facebook    = $request->facebook;
                $agent->twitter     = $request->twitter;
                $agent->instgram    = $request->instgram;
                $agent->save();
            }
            return back()->with('success','User Updated');
        } else {
            return redirect(url('user/dashboard'));
        }
    }
}

