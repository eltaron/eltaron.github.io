<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'Lang'], function () {

    Route::group(['namespace'=>'Web'], function () {

        Route::get('/', function () {
            Artisan::call('cache:clear');
            return redirect(url('home'));
        });

        Route::get('home','HomeController@index');
        Route::get('about','HomeController@about');
        Route::get('ads','HomeController@ads');
        Route::get('ads/like/{id}','HomeController@ads_like');
        Route::get('adsDetails/{id}','HomeController@adsDetails');
        Route::get('agents','HomeController@agents');
        Route::get('contact','HomeController@contact');
        Route::get('blog','HomeController@blog');
        Route::get('blogDetails/{id}','HomeController@blogDetails');
        Route::post('blog/sendMessage','HomeController@sendMessage');
        Route::post('ads/sendMessage','HomeController@sendMessageAds');
        Route::get('login','AuthController@login');
        Route::get('register','AuthController@register');
        Route::get('forgetPassword','AuthController@forgetPassword');
        Route::get('resetPassword/{email}','AuthController@resetPassword');
        Route::get('logout','AuthController@logout');
        Route::post('contact/message','HomeController@message');
        Route::get('agentDetail/{id}','HomeController@agentDetail');
        Route::post('search','HomeController@search');
        Route::post('storeData','AuthController@store');
        Route::post('login','AuthController@log');
        Route::post('forgetPassword','AuthController@forget');
        Route::post('resetPassword','AuthController@reset');
        Route::get('language/{lang}','SettingController@language');
        Route::group(['middleware' => ['auth']], function() {
            Route::get('chat/{id}','chatController@index');
            Route::post('chat/store','chatController@store');
            Route::group(['prefix'=>'user'], function () {
                Route::get('','dashboardController@dashboard');
                Route::get('dashboard','dashboardController@dashboard');
                Route::group(['prefix' => 'ads'], function() {
                    Route::get('','adsController@index');
                    Route::get('create','adsController@create');
                    Route::post('create','adsController@store');
                    Route::get('show/{id}','adsController@show');
                    Route::get('edit/{id}','adsController@edit');
                    Route::post('disactivate','adsController@disactivate');
                    Route::post('delete','adsController@destroy');
                    Route::post('activate','adsController@activate');
                    Route::post('delete_ads','adsController@delete_ads');
                    Route::post('allow_comment','adsController@allow_comment');
                    Route::get('edit/{id}','adsController@edit');
                    Route::post('disactivate_ads','adsController@disactivate_ads');
                    Route::post('update','adsController@update');
                    Route::post('delete_image','adsController@delete_image');
                });
                Route::get('account','accountController@index');
                Route::group(['prefix' => 'user'], function() {
                    Route::post('update/image','accountController@update_image');
                    Route::post('edit','accountController@edit');
                });
                Route::get('chat','chatController@chat');
                Route::get('chat/show/{id}','chatController@show');
                Route::post('chat/store','chatController@store2');
                Route::post('chat/complete','chatController@complete');
                Route::get('chat/invoice/{id}','chatController@invoice');
                Route::get('invoice/all','chatController@invoice_show');
                Route::post('invoice/delete','chatController@invoice_delete');
                Route::post('invoice/send','chatController@send_email');
                Route::group(['prefix' => 'messages'], function() {
                    Route::get('sent','messagesController@sent');
                    Route::post('delete','messagesController@delete');
                    Route::post('add','messagesController@add');
                });
            });
        });
        // Route::fallback(function () {
        //     return redirect(url('home'));
        // });
    });
});
