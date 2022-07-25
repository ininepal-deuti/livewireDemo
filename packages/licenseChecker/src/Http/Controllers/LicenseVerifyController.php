<?php
namespace LicenseChecker\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LicenseChecker\Classes\License;
use LicenseChecker\Http\Requests\LicenseRequest;

class LicenseVerifyController extends Controller
{
    protected $customLicense;

    public function __construct(License $customLicense)
    {
        $this->customLicense = $customLicense;
    }

    public function index()
    {
        return $this->customLicense->showLicenseForm();
    }

    public function verifyLicense(LicenseRequest $request)
    {
        return $this->customLicense->verifyLicense($request->all());
    }
}
