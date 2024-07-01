<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubcategoriesRequest extends FormRequest
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
            'id_cat'=>'required',
            'nm_subcat'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'id_cat.required'=>'Kategori Harus Diisi',
            'nm_subcat.required'=>'Sub Kategori Harus Diisi',
        ];
    }
}