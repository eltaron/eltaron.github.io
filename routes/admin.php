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
        Route::group(['namespace'=>'Admin'], function () {
            Route::get('','HomeController@dashboard');
            Route::get('language/{lang}','SettingController@language');
            Route::post('login','AuthController@auth');
            Route::get('dashboard','HomeController@dashboard');
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
            Route::group(['prefix' => 'messages'], function() {
                Route::get('sent','messagesController@sent');
                Route::get('recieved','messagesController@recieved');
                Route::post('delete','messagesController@delete');
                Route::post('add','messagesController@add');
            });
            Route::group(['prefix' => 'user'], function() {
                Route::get('','userController@index');
                Route::get('agent','userController@agent');
                Route::post('delete','userController@delete');
                Route::post('disactivate','userController@disactivate');
                Route::post('activate','userController@activate');
                Route::get('show/{id}','userController@show');
                Route::post('edit_image_back','userController@edit_image_back');
                Route::post('edit_back','userController@edit_back');
            });
            Route::group(['prefix' => 'invoice'], function() {
                Route::get('all','chatController@invoice');
                Route::post('delete','chatController@invoice_delete');
                Route::get('show/{id}','chatController@invoice_show');
            });
            Route::get('logout','SettingController@logout');
        });

});
