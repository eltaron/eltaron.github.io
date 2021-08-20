<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class blogController extends Controller
{
    public function index(){
        if(Auth::user()->admin == 1){
            $blog = Blog::with('image')->latest()->paginate(10);
            $blogs = Blog::orderBy('id', 'desc')->take(5)->get();
            return view('admin.blog.index')->with([
                'title'=>trans('web.Blogs'),
                'blogs'=>$blog,
                'leatest_blogs'=>$blogs
            ]);
        } else {
            return redirect(url('/'));
        }
    }
    public function create(){
        if(Auth::user()->admin == 1){
            return view('admin.blog.create')->with([
                'title'=>trans('web.Create Blog'),
            ]);
        } else {
            return redirect(url('/'));
        }
    }
    public function comments(){
        if(Auth::user()->admin == 1){
            return view('admin.blog.comments')->with([
                'title'=>trans('web.Blog Comments'),
            ]);
        } else {
            return redirect(url('/'));
        }
    }
    public function store(Request $request){
        if(Auth::user()->admin == 1) {
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
            return redirect(aurl('blog'))->with('success','Blog Added Success');
        } else {
            return redirect(url('/'));
        }
    }
    public function show($id){
        if(Auth::user()->admin == 1) {
            $blog= Blog::where('id',$id)->latest()->first();
            $comments = Comment::where('blog_id' , $id)->get();
            $images   = Image::where('blog_id',$id)->get();
            $blogs = Blog::orderBy('id', 'desc')->take(5)->get();
            return view('admin.blog.show')->with([
                'title'=>trans('web.Show Blogs'),
                'blog'=>$blog,
                'comments'=>$comments,
                'images'=>$images,
                'leatest_blogs'=>$blogs
            ]);
        } else {
            return redirect(url('/'));
        }
    }
    public function activate(Request $request){
        if(Auth::user()->admin == 1) {
            $Blog = Blog::where('id' , $request->blog_id)->first();
            if($Blog){
                $Blog->status = 1;
                $Blog->save();
                return back()->with('success','Article Activated');
            } else {
                return back()->with('faild','Article Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function delete_blog(Request $request){
        if(Auth::user()->admin == 1) {
            $Blog = Blog::where('id' , $request->blog_id)->first();
            if($Blog){
                $Blog->delete();
                return back()->with('success','Article Deleted');
            } else {
                return back()->with('faild','Article Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function allow_comment(Request $request){
        if(Auth::user()->admin == 1) {
            $Blog = Blog::where('id' , $request->blog_id)->first();
            if($Blog){
                $Blog->allow_comment = 1;
                $Blog->save();
                return back()->with('success','Article Updated');
            } else {
                return back()->with('faild','Article Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function disactivate_blog(Request $request){
        if(Auth::user()->admin == 1) {
            $Blog = Blog::where('id' , $request->blog_id)->first();
            if($Blog){
                $Blog->status = 0;
                $Blog->save();
                return back()->with('success','Article Not Activated');
            } else {
                return back()->with('faild','Article Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function edit($id){
        if(Auth::user()->admin == 1) {
            $Blog = Blog::where('id' , $id)->first();
            $images   = Image::where('blog_id',$id)->get();
            if($Blog){
                return view('admin.blog.edit')->with([
                    'title'=>trans('web.Edit Article'),
                    'blog'=>$Blog,
                    'images'=>$images
                ]);
            } else {
                return back()->with('faild','Blog Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function update(Request $request) {
        if(Auth::user()->admin == 1) {
            $blog = Blog::where('id' , $request->blog_id)->first();
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
            return redirect(url('/'));
        }
    }
    public function delete_image(Request $request) {
        if(Auth::user()->admin == 1) {
            $imagesOfBlog = Image::where('blog_id' , $request->blog_id)->get();
            if($imagesOfBlog->count() > 1){
                $blog = Image::where('id' , $request->image_id)->first();
                if($blog){
                    $blog->delete();
                    return back()->with('success','Image Deleted');
                } else {
                    return back()->with('faild','Image Not Found');
                }
            } else {
                return back()->with('faild','You cant delete image');
            }
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
}
