<?php

namespace App\Http\Requests\File;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreImageRequest extends FormRequest
{
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
     * @return array
     */
    public function rules()
    {
        return [
            'upload' => 'required|image',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'uploaded' => 0,
            'error' => [
                'message' => $validator->errors()->first()
            ],
        ], 400);
        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag);
    }
}
