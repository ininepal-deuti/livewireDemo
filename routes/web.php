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


Route::group(['prefix' => 'login', 'middleware' => 'auth'], function () {
    Route::get('/facebook', [\App\Http\Controllers\SocialController::class, 'redirectToProvider']);
    Route::get('/callback', [\App\Http\Controllers\SocialController::class, 'handleProviderCallback']);
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/posts', [\App\Http\Livewire\Posts::class, 'index'])->name('posts.index');
Route::get('/users', [\App\Http\Livewire\Users::class, 'index'])->name('users.index');

Route::get('timezones/{timezone}', 'PCB\TimeZones\TimezonesController@index');


