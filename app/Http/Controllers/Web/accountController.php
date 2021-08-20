<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Blog;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class accountController extends Controller
{
    public function index(){
        if(Auth::user()->agent != 1) {
            $ads = Ads::where('user_id',Auth::user()->id)->get();
            $blogs = Blog::where('user_id',Auth::user()->id)->get();
            return view('web.account.index')->with([
                'title'=>trans('web.Account'),
                'ads'=>$ads,
                'blogs'=>$blogs,
                'cities'=>City::all()
            ]);
        } else {
            return redirect(gurl('/'));
        }
    }
    public function update_image(Request $request){
        if(Auth::user()->agent != 1) {
            $request->validate([
                'image'    =>  'required',
            ], [], [
                'image'    => trans('web.Image'),
            ]);
            $user = User::where('id',Auth::user()->id)->first();
            $mainpath = date("Y-m-d").'/';
            $file = $request->file('image');
            if (isset($file)){
                $fileNameWithExtension = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $imageName = $fileName.'_'.time().'.'.$extension;
                $path = $file->move(public_path('storage/logos/'.$mainpath), $imageName);
                $user->image = url('').'/storage/logos/'.$mainpath.$imageName;
                $user->save();
                return back()->with('success','Image Updated');
            }
            return back()->with('faild','An error occured');
        } else {
            return redirect(gurl('/'));
        }
    }
    public function edit(Request $request){
        if(Auth::user()->agent != 1) {
            $user  = User::where('id',Auth::user()->id)->first();
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->city_id      = $request->city;
            $user->description  = $request->description;
            $user->save();
            return back()->with('success','User Updated');
        } else {
            return redirect(gurl('/'));
        }
    }
}
