<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorelinesRequest extends FormRequest
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
            'id_area'=>'required',
            'no_line'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'id_area.required'=>'Area Harus Diisi',
            'no_line.required'=>'No Line Harus Diisi',
        ];
    }
}