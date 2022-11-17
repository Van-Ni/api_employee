<?php

namespace App\Modules\Company\Requests;

use App\Helpers\CommonRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class DestroyCompanyRequest extends FormRequest
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
           'listCheck' => 'required'
        ];
    }

    public function messages()
    {
        return [
          'listCheck.required' => "Need to select record"
        ];
    }

    // show error
    public function failedValidation(Validator $validator)
    {
        return $this->commonRequest->validateCommonBadRequest($validator);
    }
}
