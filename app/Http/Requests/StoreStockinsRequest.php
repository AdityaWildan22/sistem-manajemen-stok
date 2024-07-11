<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockinsRequest extends FormRequest
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
            'no_trans' => 'required|unique:stockins,no_trans',
            'tgl_masuk' => 'required',
            'file' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'details' => 'required|array|min:1',
            'details.*.id_barang' => 'required',
            'details.*.jumlah' => 'required',
            'details.*.satuan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'no_trans.required' => 'Nomor Transaksi Harus Diisi',
            'no_trans.unique' => 'Nomor Transaksi Sudah Digunakan',
            'tgl_masuk.required' => 'Tanggal Masuk Harus Diisi',
            'file.image' => 'File Harus Berupa Gambar',
            'file.mimes' => 'Ekstensi File Tidak Valid',
            'file.max' => 'File Maksimal 2Mb',
            'details.required' => 'Detail Harus Diisi',
            'details.*.id_barang.required' => 'Nama Material Harus Diisi',
            'details.*.jumlah.required' => 'Jumlah Harus Diisi',
            'details.*.satuan.required' => 'Satuan Harus Diisi',
        ];
    }
}