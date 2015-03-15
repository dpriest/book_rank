<?php

/*
|--------------------------------------------------------------------------
| Applibookion Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an applibookion.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    return Redirect::to('ranks');
});
Route::get('books', function(){
    $books = Book::all();
    return View::make('books.index')
        ->with('books', $books);
});
Route::get('books/ranks/{name}', function($name){
    $rank = Rank::whereName($name)->with('books')->first();
    return View::make('books.index')
        ->with('ranks', $rank)
        ->with('books', $rank->books);
});
Route::get('ranks/{rank}/createBook', 'RankController@createBook');
Route::post('ranks/{rank}/storeBook', 'RankController@storeBook');
Route::resource('ranks','RankController');
Route::model('rank', 'Rank');
Route::get('ranks/{rank}/rank', 'RankController@rank');
Route::get('ranks/{rank}/delete', 'RankController@delete');
Route::controller('ajax', 'AjaxController');

Route::get('ranks/create', function() {
    $rank = new Rank;
    return View::make('ranks.edit')
        ->with('rank', $rank)
        ->with('method', 'post');
});
Route::get('books/{book}/edit', function(Book $book) {
    return View::make('books.edit')
        ->with('book', $book)
        ->with('method', 'put');
});
Route::get('books/{book}/delete', function(Book $book) {
    return View::make('books.edit')
        ->with('book', $book)
        ->with('method', 'delete');
});
Route::post('books', function(){
    $book = Book::create(Input::all());
    return Redirect::to('books/' . $book->id)
        ->with('message', 'Successfully created page!');
});
Route::put('books/{book}', function(Book $book) {
    $book->update(Input::all());
    return Redirect::to('books/' . $book->id)
        ->with('message', 'Successfully updated page!');
});
Route::delete('books/{book}', function(Book $book) {
    $book->delete();
    return Redirect::to('books')
        ->with('message', 'Successfully deleted page!');
});
Route::model('book', 'Book');
Route::get('books/{book}', function(Book $book) {
    return View::make('books.single')
        ->with('book', $book);
});
View::composer('books.edit', function($view)
{
    $ranks = Rank::all();
    if(count($ranks) > 0){
        $rank_options = array_combine($ranks->lists('id'),
            $ranks->lists('name'));
    } else {
        $rank_options = array(null, 'Unspecified');
    }
    $view->with('rank_options', $rank_options);
});