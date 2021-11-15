<?php

use App\Models\Authors;
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


Route::get('authors', 'AuthorsController@index');
Route::get('authors/{id}', 'AuthorsController@show');
Route::post('authors', 'AuthorsController@store');
Route::put('authors/{id}', 'AuthorsController@update');
Route::delete('authors/{id}', 'AuthorsController@delete');



Route::get('books', 'BooksController@index');
Route::get('books/{id}', 'BooksController@show');
Route::post('books', 'BooksController@store');
Route::put('books/{id}', 'BooksController@update');
Route::delete('books/{id}', 'BooksController@delete');
