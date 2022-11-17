<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password','two_factor_secret','two_factor_recovery_codes','two_factor_confirmed_at','two_factor_confirmed'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'remember_token', 'two_factor_secret','two_factor_recovery_codes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * @var mixed
     */

    public function twoFactorAuthEnabled()
    {
        return $this->two_factor_recovery_codes != null;
    }

    public function confirmTwoFactorAuth($code) : bool
    {
        $code = str_replace(' ', '', $code);

        $codeIsValid = app(TwoFactorAuthenticationProvider::class)
            ->verify(decrypt($this->two_factor_secret), $code);

        if(decrypt($this->two_factor_secret) == $code){
            $codeIsValid = true;
        }
        if($codeIsValid){
            $this->two_factor_confirmed = true;
            $this->two_factor_confirmed_at = Carbon::now();
            $this->save();
            return true;
        }
        return false;
    }
}
