<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ads;
use App\Models\Blog;
use App\Models\Chat;
use App\Models\Contact;
use App\Models\Invoice;

class dashboardController extends Controller
{
    public function index(){
        return view('web.auth.login') ;
    }
    public function dashboard(){
        if(Auth::user()->agent != 1) {
            $latestads = Ads::where('user_id',Auth::user()->id)->where('status',1)->orderby('id','DESC')->take(6)->get();
            return view('web.dashboard.index')->with([
                'ads'=>Ads::where('user_id',Auth::user()->id)->count(),
                'chats'=>Chat::where('agent_id',Auth::user()->id)->count(),
                'messages'=>Contact::where('user_id',Auth::user()->id)->count(),
                'latestads'=>$latestads,
                'invoices'=>Invoice::where('agent_id',Auth::user()->id)->count(),
            ]);
        } else {
            return redirect(gurl(''));
        }
    }
}
