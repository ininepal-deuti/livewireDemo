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


//Route::group(['prefix' => 'login', 'middleware' => 'auth'], function () {
//    Route::get('/facebook', [\App\Http\Controllers\SocialController::class, 'redirectToProvider']);
//    Route::get('/callback', [\App\Http\Controllers\SocialController::class, 'handleProviderCallback']);
//});

Auth::routes();

//2F auth
Route::group(['middleware'=>'auth'],function(){
    Route::post('/user/two-factor-authentication/' ,[App\Http\Controllers\TwoFactorAuthenticationController::class, 'twoFactorEnable'])
        ->name('auth.two_factor.enable');
    Route::delete('/user/two-factor-authentication-disabled/' ,[App\Http\Controllers\TwoFactorAuthenticationController::class, 'twoFactorDisable'])
        ->name('auth.two_factor.disable');
    Route::post('/2fa-confirm', [App\Http\Controllers\TwoFactorAuthenticationController::class, 'confirm'])
        ->name('auth.two_factor.confirm');
    Route::get('/send-code', [App\Http\Controllers\TwoFactorAuthenticationController::class, 'sendCodeNotification'])
        ->name('sendCodeNotification');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/posts', [\App\Http\Livewire\Posts::class, 'index'])->name('posts.index');
Route::get('/users', [\App\Http\Livewire\Users::class, 'index'])->name('users.index');
//
//Route::get('timezones/{timezone}', 'PCB\TimeZones\TimezonesController@index');
//
//Route::get('license', [\LicenseChecker\Http\Controllers\LicenseVerifyController::class,'index'])->name('license');
//Route::post('license/verify', [\LicenseChecker\Http\Controllers\LicenseVerifyController::class,'verifyLicense'])->name('license.verify');

//Route::get('/send-email', [App\Http\Controllers\HomeController::class, 'sendEmail'])->name('sendEmail');
//
//Route::get('send-email', function(){
//    $details['email'] = 'deuti@ininepal.com';
//    //dd($details['email']);
//    try{
//        dispatch(new App\Jobs\SendEmail($details));
//        return response()->json(['message'=>'Mail Send Successfully!!']);
//    }catch (Exception $exception){
//        echo $exception->getMessage();
//    }
//});
