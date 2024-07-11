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
            'no_trans' => 'required|unique:stockouts,no_trans',
            'tgl_keluar' => 'required',
            'id_supervisor' => 'required',
            'file' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'details' => 'required|array|min:1',
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
            'no_trans.required' => 'Nomor Transaksi Harus Diisi',
            'no_trans.unique' => 'Nomor Transaksi Sudah Digunakan',
            'tgl_keluar.required' => 'Tanggal Keluar Harus Diisi',
            'id_supervisor.required' => 'Supervisor Harus Diisi',
            'file.image' => 'File Harus Berupa Gambar',
            'file.mimes' => 'Ekstensi File Tidak Valid',
            'file.max' => 'File Maksimal 2Mb',
            'details.required' => 'Detail Harus Diisi',
            'details.*.id_barang.required' => 'Material Harus Diisi',
            'details.*.jumlah.required' => 'Jumlah Harus Diisi',
            'details.*.id_area.required' => 'Area Harus Dipilih',
            'details.*.id_line.required' => 'Line Harus Dipilih',
            'details.*.id_drawing.required' => 'Drawing Harus Dipilih',
        ];
    }
}