<?php

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
    Route::group(['middleware' => ['auth']], function() {
        Route::group(['namespace'=>'Agent'], function () {
            Route::get('','HomeController@index');
            Route::get('home','HomeController@home');
            Route::get('language/{lang}','SettingController@language');
            Route::group(['prefix' => 'ads'], function() {
                Route::get('','adsController@index');
                Route::get('create','adsController@create');
                Route::post('create','adsController@store');
                Route::get('show/{id}','adsController@show');
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
            Route::group(['prefix' => 'blog'], function() {
                Route::get('','blogController@index');
                Route::get('create','blogController@create');
                Route::get('comments','blogController@comments');
                Route::post('create','blogController@store');
                Route::get('show/{id}','blogController@show');

                Route::post('disactivate','blogController@disactivate');
                Route::post('delete','blogController@destroy');

                Route::post('activate','blogController@activate');
                Route::post('delete_ads','blogController@delete_ads');
                Route::post('allow_comment','blogController@allow_comment');
                Route::get('edit/{id}','blogController@edit');
                Route::post('disactivate_ads','blogController@disactivate_ads');

                Route::post('update','blogController@update');
                Route::post('delete_image','blogController@delete_image');
            });
            Route::get('account','accountController@index');
            Route::group(['prefix' => 'user'], function() {
                Route::post('update/image','accountController@update_image');
                Route::post('edit','accountController@edit');
            });
            Route::get('chat','chatController@index');
            Route::get('chat/show/{id}','chatController@show');
            Route::post('chat/store','chatController@store');
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
            Route::get('logout','SettingController@logout');
        });
    });
});
