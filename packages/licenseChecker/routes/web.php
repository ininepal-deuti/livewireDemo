<?php

use Illuminate\Support\Facades\Route;
use LicenseChecker\Http\Controllers\LicenseVerifyController;

Route::get('license', [LicenseVerifyController::class,'index'])->name('license');
Route::post('license/verify', [LicenseVerifyController::class,'verifyLicense'])->name('license.verify');
