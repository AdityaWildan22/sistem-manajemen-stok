<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'divisi'=>'required',
            'username'=>'required',
            'password'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'Nama Harus Diisi',
            'divisi.required'=>'Divisi Harus Diisi',
            'username.required'=>'Username Harus Diisi',
            'password.required'=>'Password Harus Diisi',
        ];
    }
}