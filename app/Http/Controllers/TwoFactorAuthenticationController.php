<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;

class TwoFactorAuthenticationController extends Controller
{
    public function twoFactorEnable(EnableTwoFactorAuthentication $enable)
    {
        $user = Auth::user();
        $enable($user);
        return redirect()->back()->with('newlyEnabled',true);
    }

    public function twoFactorDisable(DisableTwoFactorAuthentication $disable)
    {
        $user = Auth::user();
        $disable($user);
        return redirect()->back();
    }
}
