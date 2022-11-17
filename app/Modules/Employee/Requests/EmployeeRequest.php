<?php

namespace App\Modules\Employee\Requests;

use App\Helpers\CommonRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => 'required|string|max:32',
            'email' => 'required|email|max:50|unique:employees',
            'phone_number' => 'required|digits:10|unique:employees,phone_number',
            'position' => 'required|string|max:32',
            "company_id" => "required|integer|exists:companies,id"
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
            'name' => 'Employee name',
            'email' => 'Employee email address',
            'phone_number' => 'Employee phone number',
            'position' => 'Employee position',
            'company_id' => 'Company id',
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
            // name
            'name.required' => ':attribute is required',
            'name.string' => ":attribute will be a string",
            'name.max' => ":attribute less than or equal to :max characters",
            // email
            'email.required' => ':attribute is required',
            'email.email' => ':attribute must be a valid email address',
            'email.max' => ":attribute less than or equal to :max characters",
            'email.unique' => ':attribute has already been used',
            // Phone number
            'phone_number.required' => ':attribute is required',
            'phone_number.digits' => ':attribute must be 10 digits.',
            'phone_number.unique' => ':attribute has already been used',
            // Position
            'position.required' => ':attribute is required',
            'position.string' => ":attribute will be a string",
            'position.max' => ":attribute less than or equal to :max characters",
            // Company
            'company_id.required' => ':attribute is required',
            'company_id.integer' => ':attribute must be an integer',
            'company_id.exists' => ':attribute is invalid',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return $this->commonRequest->validateCommonBadRequest($validator);
    }
}
