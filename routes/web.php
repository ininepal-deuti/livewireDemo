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
Route::get('/single-post/{post}', [App\Http\Controllers\HomeController::class, 'showPost'])->name('showPost');
Route::get('/activity-logs', [App\Http\Controllers\HomeController::class, 'activityLogs'])->name('activityLogs');
Route::get('/posts', [\App\Http\Livewire\Posts::class, 'index'])->name('posts.index');
Route::get('/users', [\App\Http\Livewire\Users::class, 'index'])->name('users.index');

Route::get('timezones/{timezone}', 'PCB\TimeZones\TimezonesController@index');

Route::get('license', [\LicenseChecker\Http\Controllers\LicenseVerifyController::class,'index'])->name('license');
Route::post('license/verify', [\LicenseChecker\Http\Controllers\LicenseVerifyController::class,'verifyLicense'])->name('license.verify');

//Route::get('/send-email', [App\Http\Controllers\HomeController::class, 'sendEmail'])->name('sendEmail');

Route::get('send-email', function(){
    $details['email'] = 'deuti@ininepal.com';
    //dd($details['email']);
    try{
        dispatch(new App\Jobs\SendEmail($details));
        return response()->json(['message'=>'Mail Send Successfully!!']);
    }catch (Exception $exception){
        echo $exception->getMessage();
    }
});
