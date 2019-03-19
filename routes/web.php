<?php

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

Route::get('/', function () {
    return view('firebase');
});

Route::get('/firebase', 'FireBaseController@index');
Route::post('/firebase', 'FireBaseController@store');



Route::post('/chat', 'ChatController@store');

Route::get('/chat/a', function () {
    return view('chat_a');
});

Route::get('/chat/b', function () {
    return view('chat_b');
});
