<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Agent;
use App\Models\Ads;
use App\Models\AgentAccount;
use App\Models\AgentLike;
use App\Models\Blog;
use App\Models\City;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class HomeController extends Controller
{
    public function index(){
        $latestads = Ads::where('status',1)->where('special',1)->orderby('id','DESC')->take(6)->get();
        $latestagents = User::where('agent',1)->where('special',1)->orderby('id','DESC')->take(4)->get();
        $cities = City::all();
        return view('web.home.index')->with([
            'title'=>trans('web.Home'),
            'latestads'=>$latestads,
            'cities'=>$cities,
            'latestagents'=>$latestagents,
            'name'=>'home'
        ]);
    }
    public function search(Request $request){
        $request->validate([
            'Type'       =>  'required',
            'Purpose'    =>  'required',
            'Bedrooms'   =>  'required',
            'Bathrooms'  =>  'required',
            'price'      =>  'required',
        ]);
        $ads = Ads::where([
            ['type', '=', $request->Type],
            ['purpose', '=', $request->Purpose],
            ['rooms', '=', $request->Bedrooms],
            ['baths', '=', $request->Bathrooms],
            ['price', '=', $request->price],
            ['status', '=', 1],
        ])->with('image')->orderBy('id','desc')->paginate(10);
        $latest = Ads::where('special',1)->with('image')->inRandomOrder()->take(8)->get();
        return view('web.home.ads')->with([
            'title'=>trans('web.Advertisments'),
            'advertisements'=>$ads,
            'latestads'=>$latest,
            'name'=>'ads'
        ]);
    }
    public function about(){
        return view('web.home.about')->with([
            'title'=>trans('web.About Us'),
            'name'=>'about'
        ]);
    }
    public function ads(){
        $ads = Ads::where('status',1)->with('image')->orderBy('id','desc')->paginate(10);
        $latest = Ads::where('special',1)->with('image')->inRandomOrder()->take(8)->get();
        return view('web.home.ads')->with([
            'title'=>trans('web.Advertisments'),
            'advertisements'=>$ads,
            'latestads'=>$latest,
            'name'=>'ads'
        ]);
    }
    public function ads_like($id){
        $ads = Ads::where('id',$id)->first();
        if($ads){
            if(!Auth::guest()){
                $like = AgentLike::where('user_id',Auth::user()->id)->where('ads_id',$id)->first();
                if($like){
                    return back()->with('faild','You have liked this store before');
                } else {
                    $like_new = new AgentLike();
                    $like_new->user_id = Auth::user()->id;
                    $like_new->ads_id  = $id;
                    $like_new->save();
                    return redirect(url('login'))->with('success','You Liked This Store');
                }
            } else {
                return redirect(url('login'))->with('faild','You should login first');
            }
        } else {
            return back()->with('faild','Advertisement Not Found');
        }
    }
    public function adsDetails($id){
        $ads = Ads::where('id',$id)->with('image')->first();
        if($ads){
            $images = Image::where('ads_id',$id)->get();
            $latest = Ads::where('status',1)->where('special',1)->with('image')->inRandomOrder()->take(8)->get();
            $latestads = Ads::where('status',1)->with('image')->orderby('id','DESC')->take(6)->get();
            $comments = Comment::where('ads_id',$id)->where('status',1)->get();
            $agent = User::where('id',$ads->user->id)->first();
            return view('web.home.adsDetails')->with([
                'title'=>trans('web.Ads Details'),
                'advertisement'=>$ads,
                'images'=>$images,
                'latestads'=>$latest,
                'latest'=>$latestads,
                'comments'=>$comments,
                'agent'=>$agent,
                'name'=>'ads'
            ]);
        } else {
            return back()->with('faild','Advertisement Not Found');
        }
    }
    public function contact(){
        return view('web.home.contact')->with([
            'title'=>trans('web.Contact Us'),
            'name'=>'contact'
        ]);
    }
    public function agents(){
        $agents = User::where('agent',1)->orderBy('id','desc')->paginate(12);
        return view('web.home.agents')->with([
            'title'=>trans('web.Agents'),
            'agents'=>$agents,
            'name'=>'agents'
        ]);
    }
    public function agentDetail($id){
        $agent = User::where('id',$id)->first();
        $ads = Ads::where('user_id',$agent->id)->with('image')->orderBy('id','desc')->paginate(6);
        return view('web.home.agentDetail')->with([
            'title'=>trans('web.Agent Detail'),
            'agent'=>$agent,
            'advertisments'=>$ads,
            'name'=>'agents'
        ]);
    }
    public function blog(){
        $blogs = Blog::where('status',1)->with('image')->orderBy('id','desc')->paginate(10);
        $latestblogs = Blog::where('status',1)->where('special',1)->with('image')->inRandomOrder()->take(8)->get();
        return view('web.home.blog')->with([
            'title'=>trans('web.Blogs'),
            'blogs'=>$blogs,
            'latestblogs'=>$latestblogs,
            'name'=>'blog'
        ]);
    }
    public function blogDetails($id){
        $blogs = Blog::where('id',$id)->with('image')->first();
        if(!empty($blogs)) {
            $images = Image::where('blog_id',$id)->get();
            $latest = Blog::where('status',1)->where('special',1)->inRandomOrder()->take(8)->get();
            $latestads = Blog::where('status',1)->orderby('id','DESC')->take(6)->get();
            $comments = Comment::where('blog_id',$id)->where('status',1)->get();
            return view('web.home.blogDetails')->with([
                'title'=>trans('web.Blog Details'),
                'blog'=>$blogs,
                'images'=>$images,
                'latestads'=>$latest,
                'latestblogs'=>$latestads,
                'comments'=>$comments,
                'name'=>'blog'
            ]);
        } else {
            return back()->with('faild','Article Not Found');
        }
    }
    public function sendMessage(Request $request) {
        $request->validate([
            'message'       =>  'required',
        ], [], [
            'message'       => trans('web.Messege'),
        ]);
        if($request->name && $request->email){
            $mesage = new Comment();
            $mesage->user_name  = $request->name;
            $mesage->email      = $request->email;
            $mesage->comment    = $request->message;
            $mesage->blog_id    = $request->ads_id;
            $mesage->status     = 1;
            $mesage->save();
            return back()->with('success','message sent successfully');
        } else {
            $mesage = new Comment();
            $mesage->user_id = Auth::user()->id;
            $mesage->comment = $request->message;
            $mesage->blog_id = $request->ads_id;
            $mesage->status  = 1;
            $mesage->save();
            return back()->with('success','message sent successfully');
        }
    }
    public function sendMessageAds(Request $request) {
        $request->validate([
            'message'       =>  'required',
        ], [], [
            'message'       => trans('web.Messege'),
        ]);
        if($request->name && $request->email){
            $mesage = new Comment();
            $mesage->user_name  = $request->name;
            $mesage->email      = $request->email;
            $mesage->comment    = $request->message;
            $mesage->ads_id    = $request->ads_id;
            $mesage->status     = 1;
            $mesage->save();
            return back()->with('success','message sent successfully');
        } else {
            $mesage = new Comment();
            $mesage->user_id = Auth::user()->id;
            $mesage->comment = $request->message;
            $mesage->ads_id = $request->ads_id;
            $mesage->status  = 1;
            $mesage->save();
            return back()->with('success','message sent successfully');
        }
    }
    public function message(Request $request){
        $request->validate([
            'message'       =>  'required',
        ], [], [
            'message'       => trans('web.Messege'),
        ]);
        if($request->name && $request->email){
            $mesage = new Contact();
            $mesage->user_name  = $request->name;
            $mesage->email      = $request->email;
            $mesage->message    = $request->message;
            $mesage->status     = 'recieve';
            $mesage->save();
            return back()->with('success','message sent successfully');
        } else {
            $mesage = new Contact();
            $mesage->user_id = Auth::user()->id;
            $mesage->message = $request->message;
            $mesage->status  = 'recieve';
            $mesage->save();
            return back()->with('success','message sent successfully');
        }
    }
}
