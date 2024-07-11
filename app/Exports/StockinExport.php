<?php

namespace App\Exports;

use App\Models\Stockins;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class StockinExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Stockins::with(['details.material', 'user'])
            ->get()
            ->map(function ($stockIn) {
                return $stockIn->details->map(function ($detail) use ($stockIn) {
                    return [
                        'no_trans' => $stockIn->no_trans,
                        'tgl_masuk' =>Carbon::parse($stockIn->tgl_masuk)->format('d-m-Y'),
                        'user' => $stockIn->user->name,
                        'nm_brg' => $detail->material->nm_brg,
                        'enginer' => $stockIn->enginer->name,
                        'satuan' => $detail->satuan,
                        'jumlah' => $detail->jumlah,
                    ];
                });
            })
            ->collapse();
    }

    public function headings(): array
    {
        return [
            'Nomor Transaksi',
            'Tanggal Masuk',
            'PJ',
            'Nama Material',
            'Request by Enginer',
            'Satuan',
            'Jumlah',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}