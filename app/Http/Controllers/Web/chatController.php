<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Chat;
use App\Models\ChatComment;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\invoice as MailInvoice;
use Illuminate\Support\Facades\Mail;

class chatController extends Controller
{
    public function index(Request $request,$id) {
        $ads = Ads::where('id',$id)->first();
        $chat = Chat::where('ads_id',$id)->where('user_id',Auth::user()->id)->where('type',null)->where('agent_id',$ads->user->id)->latest()->first();
        if($chat) {
            $main_chat = ChatComment::where('chat_id',$chat->id)->get();
            $chat_in = $main_chat ? $main_chat : null;
            if($request->ajax()){
                return response()->json(array('chats'=>$main_chat));
            }
            return view('web.chat.index',[
            'title'=>trans('web.Chat'),
            'chats'=>$chat_in,
            'ads'=>$ads
            ]);
        } else {
            return view('web.chat.index',[
                'title'=>trans('web.Chat'),
                'chats'=>null,
                'ads'=>$ads
            ]);
        }
    }
    public function store(Request $request) {
        $message = $request->message ? $request->message : trans('web.Image');
        if($request->message || $request->file('images')){
            $chat = Chat::where('user_id',Auth::user()->id)->where('type',null)->where('agent_id',$request->agent)->where('ads_id',$request->ads)->latest()->first();
            if($chat){
                $mainpath = date("Y-m-d").'/';
                $file = $request->file('images');
                if($file) {
                    $fileNameWithExtension = $file->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $imageName = $fileName.'_'.time().'.'.$extension;
                    $path = $file->move(public_path('storage/chats/'), $imageName);
                    $main_chat = ChatComment::create([
                            'chat_id'=> $chat->id,
                            'content'=> $message,
                            'status' => 'send',
                            'image'  => url('').'/storage/chats/'.$imageName,
                    ]);
                    return response()->json([
                        'status' => 'send',
                        'chat'=>$main_chat
                    ]);
                } else {
                    $main_chat = ChatComment::create([
                        'chat_id'=> $chat->id,
                        'content'=> $message,
                        'status' => 'send',
                    ]);
                    return response()->json([
                        'status' => 'sends',
                        'chat'   =>$main_chat
                    ]);
                }
            } else {
                $second = Chat::create([
                    'user_id'=>Auth::user()->id,
                    'agent_id'=>$request->agent,
                    'status'=>0,
                    'ads_id'=>$request->ads
                ]);
                $mainpath = date("Y-m-d").'/';
                $file = $request->file('images');
                if($file) {
                    $fileNameWithExtension = $file->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $imageName = $fileName.'_'.time().'.'.$extension;
                    $path = $file->move(public_path('storage/chats/'), $imageName);
                    $main_chat = ChatComment::create([
                            'chat_id'=> $second->id,
                            'content'=> $message,
                            'status' => 'send',
                            'image'  => url('').'/storage/chats/'.$imageName,
                    ]);
                    return response()->json([
                        'status' => 'send',
                        'chat'=>$main_chat
                    ]);
                } else {
                    $main_chat = ChatComment::create([
                        'chat_id'=> $second->id,
                        'content'=> $message,
                        'status' => 'send',
                    ]);
                    return response()->json([
                        'status' => 'sends',
                        'chat'   =>$main_chat
                    ]);
                }
            }
        } else {
            return response()->json(['error' => trans('web.You Should But A Message')]);
        }
    }

    public function chat(){
        $chats = Chat::where('agent_id',Auth::user()->id)->orderby('id','DESC')->get();
        return view('web.chat.chats')->with([
            'title'=>trans('web.Chat'),
            'chats'=>$chats
        ]);
    }

    public function show(Request $request,$id) {
        $chat = Chat::where('id',$id)->latest()->first();
        $chats = Chat::where('agent_id',Auth::user()->id)->orderby('id','DESC')->get();
        if($chat) {
            $main_chat = ChatComment::where('chat_id',$chat->id)->get();
            $chat_in = $main_chat ? $main_chat : null;
            if($request->ajax()){
                return response()->json(array('chats'=>$main_chat));
            }
            return view('web.chat.show',[
            'title'=>trans('web.Chat'),
            'chats'=>$chat_in,
            'Allchats'=>$chats,
            'chat'=>$chat
            ]);
        } else {
            return back()->with('faild','Message not Found');
        }
    }
    public function store2(Request $request) {
        $message = $request->message ? $request->message : trans('web.Image');
        if($request->message || $request->file('images')){
            $chat = Chat::where('id',$request->chat)->latest()->first();
            if($chat){
                $mainpath = date("Y-m-d").'/';
                $file = $request->file('images');
                if($file) {
                    $fileNameWithExtension = $file->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $imageName = $fileName.'_'.time().'.'.$extension;
                    $path = $file->move(public_path('storage/chats/'), $imageName);
                    $main_chat = ChatComment::create([
                            'chat_id'=> $chat->id,
                            'content'=> $message,
                            'status' => 'recieve',
                            'image'  => url('').'/storage/chats/'.$imageName,
                    ]);
                    return response()->json([
                        'status' => 'recieve',
                        'chat'=>$main_chat
                    ]);
                } else {
                    $main_chat = ChatComment::create([
                        'chat_id'=> $chat->id,
                        'content'=> $message,
                        'status' => 'recieve',
                    ]);
                    return response()->json([
                        'status' => 'recieve',
                        'chat'   =>$main_chat
                    ]);
                }
            } else {
                $second = Chat::create([
                    'user_id'=>Auth::user()->id,
                    'agent_id'=>$request->agent,
                    'status'=>0,
                    'ads_id'=>$request->ads
                ]);
                $mainpath = date("Y-m-d").'/';
                $file = $request->file('images');
                if($file) {
                    $fileNameWithExtension = $file->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $imageName = $fileName.'_'.time().'.'.$extension;
                    $path = $file->move(public_path('storage/chats/'), $imageName);
                    $main_chat = ChatComment::create([
                            'chat_id'=> $second->id,
                            'content'=> $message,
                            'status' => 'recieve',
                            'image'  => url('').'/storage/chats/'.$imageName,
                    ]);
                    return response()->json([
                        'status' => 'recieve',
                        'chat'=>$main_chat
                    ]);
                } else {
                    $main_chat = ChatComment::create([
                        'chat_id'=> $second->id,
                        'content'=> $message,
                        'status' => 'recieve',
                    ]);
                    return response()->json([
                        'status' => 'recieve',
                        'chat'   =>$main_chat
                    ]);
                }
            }
        } else {
            return response()->json(['error' => trans('web.You Should But A Message')]);
        }
    }
    public function complete(Request $request){
        $chat = Chat::where('id',$request->chat_id)->latest()->first();
        if($chat) {
            $chat->type = 'success';
            $chat->save();
            $invoice = new Invoice();
            $invoice->user_id = $request->user_id;
            $invoice->agent_id = Auth::user()->id;
            $invoice->chat_id = $request->chat_id;
            $invoice->save();
            $invoice->url = url('invoice/'.$invoice->id);
            $invoice->save();
            return back()->with('success','Chat completed with invoice');
        } else {
            return back()->with('faild','Chat not Found');
        }
    }
    public function invoice($id){
        if(Auth::user()->agent != 1) {
            $invoice = Invoice::where('chat_id',$id)->where('agent_id',Auth::user()->id)->first();
            if($invoice) {
                return view('web.chat.invoice')->with([
                    'title'=>trans('web.Invoice'),
                    'invoice'=>$invoice
                ]);
            } else {
                return back()->with('faild','Invoice Not Found');
            }
        } else {
            return redirect(gurl(''));
        }
    }
    public function invoice_show(){
        if(Auth::user()->agent != 1) {
            $invoices = Invoice::where('agent_id',Auth::user()->id)->get();
            return view('web.chat.invoice_all')->with([
                'title'=>trans('web.Invoice'),
                'invoices'=>$invoices
            ]);
        } else {
            return redirect(gurl(''));
        }
    }
    public function invoice_delete(Request $request){
        if(Auth::user()->agent != 1) {
            $Ads = Invoice::where('id' , $request->ads_id)->first();
            if($Ads){
                $Ads->delete();
                return back()->with('success','Invoice Deleted');
            } else {
                return back()->with('faild','Invoice Not Found');
            }
        } else {
            return redirect(gurl(''));
        }
    }
    public function send_email(Request $request){
        if(Auth::user()->agent != 1) {
            $user = User::where('email' , $request->email)->first();
            if($user){
                $data = [
                    'title'=>trans('web.Invoice Url'),
                    'body'=>trans('web.please follow this link to Have Your Invoice'),
                    'link'=>url('invoice/'.$request->invoice)
                ];
                Mail::to($request->email)->send(new MailInvoice($data));
                return back()->with('success','Invoice Link Has Been Sent Successful');
            } else {
                return back()->with('faild','User Not Found');
            }
        } else {
            return redirect(gurl(''));
        }
    }
}
