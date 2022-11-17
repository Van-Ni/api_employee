<?php

namespace App\Modules\Company\Requests;

use App\Helpers\CommonRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CompanyRequest extends FormRequest
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
            'address' => 'required|string|max:50'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Company name',
            'address' => 'Company address',
        ];
    }

    public function messages()
    {
        return [
            //  name
            'name.required' => ":attribute is required",
            'name.string' => ":attribute will be a string",
            'name.max' => ":attribute less than or equal to :max characters",
            //  address
            'address.required' => ":attribute is required",
            'address.string' => ":attribute will be a string",
            'address.max' => ":attribute less than or equal to :max characters",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return $this->commonRequest->validateCommonBadRequest($validator);
    }
}
