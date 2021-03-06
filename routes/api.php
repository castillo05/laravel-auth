<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@authenticate');



    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user', 'UserController@getAuthenticatedUser');
        Route::get('users', 'UserController@users');
        Route::get('ticket/{id_user}', 'TicketController@index');
        Route::post('ticket', 'TicketController@store');
        Route::get('getticket/{id}', 'TicketController@getticket');
        Route::put('ticket/{id}', 'TicketController@update');
        Route::delete('ticket/{id}', 'TicketController@destroy');
        Route::get('tickets', 'TicketController@tickets');
        Route::get('countticket', 'TicketController@countticket');
    });
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
