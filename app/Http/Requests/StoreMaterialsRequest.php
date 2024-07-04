<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialsRequest extends FormRequest
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
            'kd_brg'=>'required',
            'nm_brg'=>'required',
            'id_cat'=>'required',
            'id_subcat'=>'required',
            'size1'=>'required',
            'satuan'=>'required',
            'stok'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'kd_brg.required' => 'Kode Material Harus Diisi',
            'nm_brg.required' => 'Nama Material Harus Diisi',
            'id_cat.required' => 'Kategori Harus Dipilih',
            'id_subcat.required' => 'Sub Kategori Harus Dipilih',
            'size1.required' => 'Ukuran Harus Diisi',
            'satuan.required' => 'Satuan Harus Diisi',
            'stok.required' => 'Stok Harus Diisi',
        ];
    }
}