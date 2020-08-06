<?php
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/allusers','FetchUserController@index');
    Route::get('/allusers/{number}','FetchUserController@indexNumber');
    Route::get('/alluser/{id}','FetchUserController@show');
    Route::get('/user', function( Request $request){
    return $request->user();
    });
});

Route::post('/push','FetchUserController@store');
Route::post('/signup', 'AuthController@signup');
Route::post('/login','AuthController@login');
Route::post('/facebook','AuthController@signUpWithFacebook');
Route::post('/facelock','AuthController@faceLogin');
