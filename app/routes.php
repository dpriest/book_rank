<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    return Redirect::to('book_rank');
});
Route::get('book_rank', function(){
    return "All cats";
});
Route::get('book_rank/{id}', function($id){
    return "rank #$id";
});