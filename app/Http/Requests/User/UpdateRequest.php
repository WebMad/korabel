<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'surname' => 'string|max:255',
            'name' => 'required|string|max:255',
            'patronymic' => 'string|max:255',
            'email' => 'required|unique:users,email',
            'phone' => 'required|string|max:255',
            'password' => 'string|max:255',
            'active' => 'boolean',
            'is_admin' => 'boolean',
        ];
    }
}
