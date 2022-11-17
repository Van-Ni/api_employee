<?php

namespace App\Modules\User\Requests;

use App\Helpers\CommonRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UserRegisterRequest extends FormRequest
{

    private $commonRequest;
    public function __construct(CommonRequest $commonRequest)
    {
        $this->commonRequest = $commonRequest;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:32',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'Email address',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // username
            'username.required' => 'Username is required',
            'username.string' => 'Username will be a string',
            'username.max' => "Username less than or equal to :max characters",
            // email
            'email.required' => ':attribute is required',
            'email.email' => ':attribute must be a valid email address',
            'email.max' => ":attribute less than or equal to :max characters",
            'email.unique' => ':attribute has already been used',
            // password
            'password.required' => 'Password is required',
            'password.string' => 'Password will be a string',
            'password.min' => 'Password at least :min characters',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return $this->commonRequest->validateCommonBadRequest($validator);
    }
}
