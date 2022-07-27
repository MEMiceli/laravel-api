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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')
    // dentro la cartella admin
    ->namespace('Admin') 
    // viene aggiunto admin alla rotta, esemgio admin.home
    ->name('admin.')
    // prefisso della uri
    ->prefix('admin')
    // gruppo di rotte con le caratteristiche precedenti
    ->group(function() {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('posts', 'PostController');
        Route::resource('categories', 'CategoryController');
        Route::resource('tags', 'TagController');
    });

    Route::get("{any?}", function() {
        return view("guest.home");
    })->where("any", ".*");
    


