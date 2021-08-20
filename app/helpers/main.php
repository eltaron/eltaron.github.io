<?php

use Illuminate\Support\Facades\Auth;

function sendResponseSuccess($message,$data){
    return response([
        "success" => true,
        "message" => $message,
        "data"    => $data,
    ],200);
}

function sendResponseDebug($message){
    return response([
        "success" => false,
        "message" => $message,
    ],200);
}

function sendResponseFail($message){
    // $data = new \App\ErrorLog();
    // $data->exception = $message;
    // if(userLogin()){
    //     $data->user_id = userLogin()->id;
    // }
    // $data->save();
    return response([
        "success" => false,
        // "message" => trans('app.sorry_somthing_wrong')
        "message" => $message
    ],200);
}

function sendResponseError($message){
    return response([
        "success" => false,
        // "message" => trans('app.sorry_somthing_wrong')
        "message" => $message
    ],200);
}

function sendResponseValid($message){
    return response([
        "success" => false,
        // "message" => trans('app.sorry_somthing_wrong')
        "message" => $message
    ],200);
}

function GetLanguage() {
    return app()->getLocale();
}

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

function userLogin() {
    return JWTAuth::parseToken()->authenticate();
}

if (!function_exists('aurl')) {
    function aurl($url)
    {
        return url('/admin/' . $url);
    }
}


if (!function_exists('gurl')) {
    function gurl($url)
    {
        return url('/agent/' . $url);
    }
}

if (!function_exists('lang')) {
    function lang()
    {
        if (session()->has('lang')) {
            return session()->get('lang');
        } else {
            session()->put('lang', 'ar');
            return 'ar';
        }
    }
}

if (!function_exists('notifications')) {
    function notifications()
    {
        return \App\Models\Ads::orderby('id','DESC')->get();
    }
}

if (!function_exists('agentNotifications')) {
    function agentNotifications()
    {
        return \App\Models\Chat::where('agent_id',Auth::user()->id)->orderby('id','DESC')->get();
    }
}

if (!function_exists('Ads')) {
    function Ads()
    {
        return \App\Models\Ads::where('special',1)->orderby('id','DESC')->take(8)->get();
    }
}
