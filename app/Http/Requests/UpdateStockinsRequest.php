<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStockinsRequest extends FormRequest
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
            'no_trans' => 'required',
            'tgl_masuk' => 'required',
            'details.*.id_barang' => 'required',
            'details.*.jumlah' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'no_trans.required' => 'Nomor Transaksi Harus Diisi',
            'tgl_masuk.required' => 'Tanggal Masuk Harus Diisi',
            'details.*.id_barang.required' => 'Nama Material Harus Diisi',
            'details.*.jumlah.required' => 'Jumlah Harus Diisi',
        ];
    }
}