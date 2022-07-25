<?php
namespace LicenseChecker\Classes;

class License
{
    public static function validationRules(): array
    {
        return [
            'email' => 'required|email|string',
            'license_key' => 'required|min:8|string',
        ];
    }

    public function showLicenseForm()
    {
        return view('licenseChecker::license');
    }

    public function verifyLicense($request)
    {
        $email = 'admin@gmail.com';
        $license = 'admin123';
        if($email == $request['email'] && $license == $request['license_key']){
            return redirect()->route('login');
        }else{
            return redirect()->route('license')->withErrors('Invalid Entry');
        }
    }

}

