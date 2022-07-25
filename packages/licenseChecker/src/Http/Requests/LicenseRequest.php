<?php

namespace LicenseChecker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LicenseChecker\Classes\License;

class LicenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules(): array
    {
        return $rules = [
            'email'       => ['required', 'string', 'email', 'max:255'],
            'license_key' => ['required', 'string', 'min:8'],
        ];
        //return License::validationRules();
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */

    public function messages(): array
    {
        return [
            'email.required' => 'Email field is required',
            'license_key.required' => 'License Key field is required',
        ];
    }

}

