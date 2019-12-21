<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'patronymic' => 'max:255',
            'phone' => 'max:255',
            'active' => 'boolean',
            'is_admin' => 'boolean',
        ];
    }
}
