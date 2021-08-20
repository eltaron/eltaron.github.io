<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class chatController extends Controller
{
    public function index(){
        if(Auth::user()->admin == 1){
            return view('admin.chat.index')->with([
                'title'=>trans('web.Chat'),
                'chats'=>Chat::all(),
            ]);
        } else {
            return redirect(aurl('/'));
        }
    }
    public function invoice(){
        if(Auth::user()->admin == 1){
            return view('admin.invoice.index')->with([
                'title'=>trans('web.Invoice'),
                'invoices'=>Invoice::all(),
            ]);
        } else {
            return redirect(aurl('/'));
        }
    }
    public function invoice_show($id){
        if(Auth::user()->admin == 1) {
            $invoice = Invoice::where('id',$id)->first();
            if($invoice) {
                return view('admin.invoice.invoice')->with([
                    'title'=>trans('web.Invoice'),
                    'invoice'=>$invoice
                ]);
            } else {
                return back()->with('faild','Invoice Not Found');
            }
        } else {
            return redirect(aurl('/'));
        }
    }
    public function invoice_delete(Request $request){
        if(Auth::user()->admin == 1) {
            $Ads = Invoice::where('id' , $request->invoice_id)->first();
            if($Ads){
                $Ads->delete();
                return back()->with('success','Invoice Deleted');
            } else {
                return back()->with('faild','Invoice Not Found');
            }
        } else {
            return redirect(aurl('/'));
        }
    }
}
