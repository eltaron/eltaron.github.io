<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class messagesController extends Controller
{
    public function sent(){
        if(Auth::user()->agent != 1){
            $message = Contact::where('user_id' , Auth::user()->id)->where('status','send')->orderBy('id','desc')->get();
            $sendMessages = Contact::where('user_id' , Auth::user()->id)->where('status','recieve')->orderBy('id','desc')->get();
            return view('web.messages.sent')->with([
                'title'=>trans('web.Messages'),
                'messages'=>$message,
                'sendMessages'=>$sendMessages
            ]);
        } else {
            return redirect(gurl('/'));
        }
    }
    public function delete(Request $request){
        if(Auth::user()->agent != 1){
            $Message = Contact::where('id' , $request->comment_id)->first();
            if($Message){
                $Message->delete();
                return back()->with('success','Message Deleted');
            } else {
                return back()->with('faild','Message Not Found');
            }
        } else {
            return redirect(gurl('/'));
        }
    }
    public function add(Request $request){
        if(Auth::user()->agent != 1){
            $request->validate([
                'message'       =>  'required',
            ], [], [
                'message'       => trans('web.Messege'),
            ]);
            $message = new Contact();
            $message->user_id = Auth::user()->id;
            $message->message = $request->message;
            $message->status  = 'recieve';
            $message->save();
            if($message){
                return back()->with('success','Message Sent');
            } else {
                return back()->with('faild','Message Not Found');
            }
        } else {
            return redirect(gurl('/'));
        }
    }
}
