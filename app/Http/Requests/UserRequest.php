<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public $validator = null;
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
            'name'      => 'required',
            'email'     => 'required',
            'password'  => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'The name field is required.',
            'email.required'     => 'The email field is required.',
            'password.required'  => 'The password field is required.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return $this->validator = $validator;
    }
}
