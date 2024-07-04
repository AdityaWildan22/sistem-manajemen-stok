<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockoutsRequest extends FormRequest
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
            'tgl_keluar' => 'required',
            'details.*.id_barang' => 'required',
            'details.*.jumlah' => 'required',
            'details.*.id_area' => 'required',
            'details.*.id_line' => 'required',
            'details.*.id_drawing' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'no_trans.required' => 'Nomor transaksi wajib diisi',
            'tgl_keluar.required' => 'Tanggal keluar wajib diisi',
            'details.*.id_barang.required' => 'Nama material wajib diisi',
            'details.*.jumlah.required' => 'Jumlah wajib diisi',
            'details.*.id_area.required' => 'Area wajib diisi',
            'details.*.id_line.required' => 'Line wajib diisi',
            'details.*.id_drawing.required' => 'Drawing wajib diisi',
        ];
    }
}