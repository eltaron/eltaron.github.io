<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class blogController extends Controller
{
    public function index(){
        if(Auth::user()->agent == 1) {
            $blog = Blog::where('user_id', Auth::user()->id)->with('image')->latest()->paginate(10);
            $blogs = Blog::orderBy('id', 'desc')->take(5)->get();
            return view('agent.blog.index')->with([
                'title'=>trans('web.Blogs'),
                'blogs'=>$blog,
                'leatest_blogs'=>$blogs
            ]);
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function create(){
        if(Auth::user()->agent == 1) {
            return view('agent.blog.create')->with([
                'title'=>trans('web.Create Blog'),
            ]);
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function comments(){
        if(Auth::user()->agent == 1) {
            return view('agent.blog.comments')->with([
                'title'=>trans('web.Blog Comments'),
            ]);
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function store(Request $request){
        if(Auth::user()->agent == 1) {
            $request->validate([
                'title'       =>  'required',
                'text'        =>  'required',
            ], [], [
                'title'       => trans('web.Title Of New Blog'),
                'text'        => trans('web.Text Of New Blog'),

            ]);
            $blog = new Blog();
                $blog->name          =$request->title;
                $blog->text          =$request->text;
                $blog->status        =0;
                $blog->allow_comment =0;
                $blog->special       =0;
                $blog->user_id       =Auth::user()->id;
            $blog->save();
            $mainpath = date("Y-m-d").'/';
            $files = $request->file('files');
            if (isset($files)){
                foreach($files as $file){
                    $fileNameWithExtension = $file->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $imageName = $fileName.'_'.time().'.'.$extension;
                    $path = $file->move(public_path('storage/blog/'.$mainpath), $imageName);
                    $entry = new Image();
                        $entry->blog_id  = $blog->id;
                        $entry->url = url('').'/storage/blog/'.$mainpath.$imageName;
                    $entry->save();
                }
            } else {
                $entry = new Image();
                $name = 'none.png';
                $entry->blog_id  = $blog->id;
                $entry->url = url('').'/storage/blog/'.$name;
                $entry->save();
            }
            return redirect(gurl('blog'))->with('success','Blog Added Success');
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function show($id){
        if(Auth::user()->agent == 1) {
            $blog= Blog::where('user_id',Auth::user()->id)->where('id',$id)->latest()->first();
            $comments = Comment::where('blog_id' , $id)->get();
            $images   = Image::where('blog_id',$id)->get();
            $blogs = Blog::orderBy('id', 'desc')->take(5)->get();
            return view('agent.blog.show')->with([
                'title'=>trans('web.Show Blogs'),
                'blog'=>$blog,
                'comments'=>$comments,
                'images'=>$images,
                'leatest_blogs'=>$blogs
            ]);
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function activate(Request $request){
        if(Auth::user()->agent == 1) {
            $Blog = Blog::where('id' , $request->ads_id)->first();
            if($Blog){
                $Blog->status = 1;
                $Blog->save();
                return back()->with('success','Article Activated');
            } else {
                return back()->with('faild','Article Not Found');
            }
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function delete_ads(Request $request){
        if(Auth::user()->agent == 1) {
            $Blog = Blog::where('id' , $request->ads_id)->first();
            if($Blog){
                $Blog->delete();
                return back()->with('success','Article Deleted');
            } else {
                return back()->with('faild','Article Not Found');
            }
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function allow_comment(Request $request){
        if(Auth::user()->agent == 1) {
            $Blog = Blog::where('id' , $request->ads_id)->first();
            if($Blog){
                $Blog->allow_comment = 1;
                $Blog->save();
                return back()->with('success','Article Updated');
            } else {
                return back()->with('faild','Article Not Found');
            }
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function disactivate_ads(Request $request){
        if(Auth::user()->agent == 1) {
            $Blog = Blog::where('id' , $request->ads_id)->first();
            if($Blog){
                $Blog->status = 0;
                $Blog->save();
                return back()->with('success','Article Not Activated');
            } else {
                return back()->with('faild','Article Not Found');
            }
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function edit($id){
        if(Auth::user()->agent == 1) {
            $Blog = Blog::where('id' , $id)->where('user_id' , Auth::user()->id)->first();
            $images   = Image::where('blog_id',$id)->get();
            if($Blog){
                return view('agent.blog.edit')->with([
                    'title'=>trans('web.Edit Article'),
                    'blog'=>$Blog,
                    'images'=>$images
                ]);
            } else {
                return back()->with('faild','Blog Not Found');
            }
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function update(Request $request) {
        if(Auth::user()->agent == 1) {
            $blog = Blog::where('id' , $request->ads_id)->first();
            if($blog){
                $blog->name          =$request->title;
                $blog->text          =$request->text;
                $blog->user_id       =Auth::user()->id;
                $blog->save();
                $mainpath = date("Y-m-d").'/';
                $files = $request->file('files');
                if (isset($files)){
                    foreach($files as $file){
                        $fileNameWithExtension = $file->getClientOriginalName();
                        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                        $extension = $file->getClientOriginalExtension();
                        $imageName = $fileName.'_'.time().'.'.$extension;
                        $path = $file->move(public_path('storage/blog/'.$mainpath), $imageName);
                        $entry = new Image();
                            $entry->blog_id  = $blog->id;
                            $entry->url = url('').'/storage/blog/'.$mainpath.$imageName;
                        $entry->save();
                    }
                }
                return back()->with('success','Article Updated');
            } else {
                return back()->with('faild','Article Not Found');
            }
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function delete_image(Request $request) {
        if(Auth::user()->agent == 1) {
            $imagesOfAds = Image::where('blog_id' , $request->ads_id)->get();
            if($imagesOfAds->count() > 1){
                $Ads = Image::where('id' , $request->image_id)->first();
                if($Ads){
                    $Ads->delete();
                    return back()->with('success','Image Deleted');
                } else {
                    return back()->with('faild','Image Not Found');
                }
            } else {
                return back()->with('faild','You cant delete image');
            }
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function disactivate(Request $request) {
        if(Auth::user()->agent == 1) {
            $comment = Comment::where('id' , $request->comment_id)->first();
            if($comment){
                $comment->status = 0;
                $comment->save();
                return back()->with('success','Comment Updated');
            } else {
                return back()->with('faild','Comment Not Found');
            }
        } else {
            return redirect(url('user/dashboard'));
        }
    }
    public function destroy(Request $request){
        if(Auth::user()->agent == 1) {
            $comment = Comment::where('id' , $request->comment_id)->first();
            if($comment){
                $comment->delete();
                return back()->with('success','Comment Deleted');
            } else {
                return back()->with('faild','Comment Not Found');
            }
        } else {
            return redirect(url('user/dashboard'));
        }
    }
}

