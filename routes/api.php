<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LoginViaSanctumController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//laravel sanctum api routes
Route::group( ['prefix' => 'sanctum/','middleware' => ['api'] ],function() {

    Route::post('login', [LoginViaSanctumController::class, 'login']);
    Route::post('register', [LoginViaSanctumController::class, 'register']);
    Route::get('dashboard', [LoginViaSanctumController::class, 'dashboard'])
        ->middleware(['auth:sanctum', 'ability:admin']);
});








//laravel passport api routes
Route::post('admin/login',[LoginController::class, 'adminLogin'])->name('adminLogin');
Route::post('admin/logout',[LoginController::class, 'adminLogout'])->name('adminLogout');
Route::group( ['prefix' => 'admin','middleware' => ['auth:admin-api','scopes:admin'] ],function(){
    // authenticated staff routes here
    Route::get('dashboard',[LoginController::class, 'adminDashboard']);
});

Route::post('customer/login',[LoginController::class, 'customerLogin'])->name('customerLogin');
Route::post('customer/logout',[LoginController::class, 'customerLogout'])->name('customerLogout');
Route::group( ['prefix' => 'customer','middleware' => ['auth:customer-api','scopes:customer'] ],function(){
    // authenticated staff routes here
    Route::get('dashboard',[LoginController::class, 'customerDashboard']);
});
