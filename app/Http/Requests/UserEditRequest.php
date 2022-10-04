<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:255|email',
            'cedula' => 'required|max:11',
            'phone_number' => 'nullable|size:10',
            'birthday' => 'required|date|before:-18 years',
            'city_id' => 'required'
        ];
    }
}
