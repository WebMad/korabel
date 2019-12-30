<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        $id = $this->route('user');
        if (!$id) {
            $id = Auth::user()->id;
        }
        return [
            'surname' => 'string|max:255',
            'name' => 'required|string|max:255',
            'patronymic' => 'string|max:255',
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'max:255',
            'password' => 'max:255',
            'active' => 'boolean',
            'is_admin' => '',
        ];
    }
}
