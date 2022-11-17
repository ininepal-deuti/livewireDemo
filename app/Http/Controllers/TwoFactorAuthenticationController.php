<?php

namespace App\Http\Controllers;

use App\Notifications\TwoFactorAuth;
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

    //to check user authentication code is valid or not
    public function confirm(Request $request)
    {
        $user = Auth::user();
        $confirmed = $user->confirmTwoFactorAuth($request->code);
        if(!$confirmed){
            return back()->withErrors('Invalid authentication code');
        }
        return back();
    }

    public function sendCodeNotification()
    {
        $user = Auth::user();
        $user->notify(new TwoFactorAuth());
        return redirect()->back();
    }
}
