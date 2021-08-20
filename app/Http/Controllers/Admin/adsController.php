<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adsController extends Controller
{
    public function index(){
        if(Auth::user()->admin == 1){
            $ads = Ads::with('image')->latest()->paginate(10);
            return view('admin.ads.index')->with([
                'title'=>trans('web.Advertisements'),
                'advertisments'=>$ads,
            ]);
        } else {
            return redirect(aurl('/'));
        }
    }
    public function create(){
        if(Auth::user()->admin == 1){
            return view('admin.ads.create')->with([
                'title'=>trans('web.Create Advertisements'),
            ]);
        } else {
            return redirect(url('/'));
        }
    }
    public function comments(){
        if(Auth::user()->admin == 1){
            return view('admin.ads.comments')->with([
                'title'=>trans('web.Ads Comments'),
            ]);
        } else {
            return redirect(url('/'));
        }
    }
    public function store(Request $request){
        if(Auth::user()->admin == 1) {
            $request->validate([
                'title'       =>  'required',
                'description' =>  'required',
                'type'        =>  'required',
                'purpose'     =>  'required',
                'area'        =>  'required',
                'rooms'       =>  'required',
                'baths'       =>  'required',
                'price'       =>  'required',
                'location'    =>  'required',
            ], [], [
                'title'       => trans('web.Title Of New Advertisement'),
                'description' => trans('web.Description Of New Advertisement'),
                'type'        => trans('web.Type'),
                'purpose'     => trans('web.Purpose'),
                'area'        => trans('web.Area Of Department In sqft'),
                'rooms'       => trans('web.No Of Rooms'),
                'baths'       => trans('web.No Of Baths'),
                'price'       => trans('web.Price'),
                'location'    => trans('web.Location'),
            ]);
            $ads = new Ads();
                $ads->name          =$request->title;
                $ads->description   =$request->description;
                $ads->type          =$request->type;
                $ads->purpose       =$request->purpose;
                $ads->area          =$request->area;
                $ads->rooms         =$request->rooms;
                $ads->baths         =$request->baths;
                $ads->price         =$request->price;
                $ads->location      =$request->location;
                $ads->status        =0;
                $ads->allow_comment =0;
                $ads->video         =$request->video;
                $ads->user_id       =Auth::user()->id;
            $ads->save();
            $mainpath = date("Y-m-d").'/';
            $files = $request->file('files');
            if (isset($files)){
                foreach($files as $file){
                    $fileNameWithExtension = $file->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $imageName = $fileName.'_'.time().'.'.$extension;
                    $path = $file->move(public_path('storage/ads/'.$mainpath), $imageName);
                    $entry = new Image();
                        $entry->ads_id  = $ads->id;
                        $entry->url = url('').'/storage/ads/'.$mainpath.$imageName;
                    $entry->save();
                }
            } else {
                $entry = new Image();
                $name = 'none.png';
                $entry->ads_id  = $ads->id;
                $entry->url = url('').'/storage/ads/'.$name;
                $entry->save();
            }
            return redirect(aurl('ads'))->with('success','Advertisement Added Success');
        } else {
            return redirect(url('/'));
        }
    }
    public function show($id){
        if(Auth::user()->admin == 1) {
            $advertise = Ads::where('user_id',Auth::user()->id)->where('id',$id)->latest()->first();
            $comments = Comment::where('ads_id' , $id)->get();
            $images   = Image::where('ads_id',$id)->get();
            return view('admin.ads.show')->with([
                'title'=>trans('web.Show Advertisements'),
                'advertise'=>$advertise,
                'comments'=>$comments,
                'images'=>$images
            ]);
        } else {
            return redirect(url('/'));
        }
    }
    public function disactivate(Request $request) {
        if(Auth::user()->admin == 1) {
            $comment = Comment::where('id' , $request->comment_id)->first();
            if($comment){
                $comment->status = 0;
                $comment->save();
                return back()->with('success','Comment Updated');
            } else {
                return back()->with('faild','Comment Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function destroy(Request $request){
        if(Auth::user()->admin == 1) {
            $comment = Comment::where('id' , $request->comment_id)->first();
            if($comment){
                $comment->delete();
                return back()->with('success','Comment Deleted');
            } else {
                return back()->with('faild','Comment Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function activate(Request $request){
        if(Auth::user()->admin == 1) {
            $ads = Ads::where('id' , $request->ads_id)->first();
            if($ads){
                $ads->status = 1;
                $ads->save();
                return back()->with('success','Advertisement Activated');
            } else {
                return back()->with('faild','Advertisement Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function delete_ads(Request $request){
        if(Auth::user()->admin == 1) {
            $Ads = Ads::where('id' , $request->ads_id)->first();
            if($Ads){
                $Ads->delete();
                return back()->with('success','Advertisement Deleted');
            } else {
                return back()->with('faild','Advertisement Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function allow_comment(Request $request){
        if(Auth::user()->admin == 1) {
            $Ads = Ads::where('id' , $request->ads_id)->first();
            if($Ads){
                $Ads->allow_comment = 1;
                $Ads->save();
                return back()->with('success','Advertisement Updated');
            } else {
                return back()->with('faild','Advertisement Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function disactivate_ads(Request $request){
        if(Auth::user()->admin == 1) {
            $ads = Ads::where('id' , $request->ads_id)->first();
            if($ads){
                $ads->status = 0;
                $ads->save();
                return back()->with('success','Advertisement Not Activated');
            } else {
                return back()->with('faild','Advertisement Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function edit($id){
        if(Auth::user()->admin== 1) {
            $ads = Ads::where('id' , $id)->where('user_id' , Auth::user()->id)->first();
            $images   = Image::where('ads_id',$id)->get();
            if($ads){
                return view('admin.ads.edit')->with([
                    'title'=>trans('web.Edit Advertisements'),
                    'ads'=>$ads,
                    'images'=>$images
                ]);
            } else {
                return back()->with('faild','Advertisement Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function update(Request $request) {
        if(Auth::user()->admin == 1) {
            $ads = Ads::where('id' , $request->ads_id)->first();
            if($ads){
                $ads->name          =$request->title;
                $ads->description   =$request->description;
                $ads->type          =$request->type;
                $ads->purpose       =$request->purpose;
                $ads->area          =$request->area;
                $ads->rooms         =$request->rooms;
                $ads->baths         =$request->baths;
                $ads->price         =$request->price;
                $ads->location      =$request->location;
                $ads->video         =$request->video;
                $ads->save();
                $mainpath = date("Y-m-d").'/';
                $files = $request->file('files');
                if (isset($files)){
                    foreach($files as $file){
                        $fileNameWithExtension = $file->getClientOriginalName();
                        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                        $extension = $file->getClientOriginalExtension();
                        $imageName = $fileName.'_'.time().'.'.$extension;
                        $path = $file->move(public_path('storage/ads/'.$mainpath), $imageName);
                        $entry = new Image();
                            $entry->ads_id  = $request->ads_id;
                            $entry->url = url('').'/storage/ads/'.$mainpath.$imageName;
                        $entry->save();
                    }
                }
                return back()->with('success','Advertisement Updated');
            } else {
                return back()->with('faild','Advertisement Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function delete_image(Request $request) {
        if(Auth::user()->admin == 1) {
            $imagesOfAds = Image::where('ads_id' , $request->ads_id)->get();
            if($imagesOfAds->count() > 1){
                $Ads = Image::where('id' , $request->image_id)->first();
                if($Ads){
                    $Ads->delete();
                    return back()->with('success','Image Deleted');
                } else {
                    return back()->with('faild','Image Not Found');
                }
            } else {
                return back()->with('faild','You can not delete image');
            }
        } else {
            return redirect(url('/'));
        }
    }
}
