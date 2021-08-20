<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class messagesController extends Controller
{
    public function sent(){
        if(Auth::user()->admin == 1){
            $message = Contact::where('status','send')->get();
            $RecieveMessages = Contact::where('status','recieve')->get();
            return view('admin.messages.sent')->with([
                'title'=>trans('web.Messages'),
                'messages'=>$message,
                'RecieveMessages'=>$RecieveMessages
            ]);
        } else {
            return redirect(url('/'));
        }
    }
    public function delete(Request $request){
        if(Auth::user()->admin == 1){
            $Message = Contact::where('id' , $request->comment_id)->first();
            if($Message){
                $Message->delete();
                return back()->with('success','Message Deleted');
            } else {
                return back()->with('faild','Message Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
    public function add(Request $request){
        if(Auth::user()->admin == 1){
            $request->validate([
                'message'       =>  'required',
                'user_id'       =>  'required',
            ], [], [
                'message'       => trans('web.Messege'),
            ]);
            $message = new Contact();
            $message->user_id = $request->user_id;
            $message->message = $request->message;
            $message->status  = 'send';
            $message->save();
            if($message){
                return back()->with('success','Message Sent');
            } else {
                return back()->with('faild','Message Not Found');
            }
        } else {
            return redirect(url('/'));
        }
    }
}
