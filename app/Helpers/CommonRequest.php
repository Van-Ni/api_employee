<?php

namespace App\Helpers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class CommonRequest
{
    public function validateCommonBadRequest($validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'code' => TransformerResponse::HTTP_BAD_REQUEST,
                'message' => TransformerResponse::BAD_REQUEST_MESSAGE,
                'data' => $errors
            ],
            TransformerResponse::HTTP_BAD_REQUEST
        ));
    }
   
}