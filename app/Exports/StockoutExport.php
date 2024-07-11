<?php

namespace App\Exports;

use App\Models\Stockouts;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class StockoutExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Stockouts::with(['user', 'details.material', 'details.area', 'details.line', 'details.drawing'])
            ->get()
            ->map(function ($stockOut) {
                return $stockOut->details->map(function ($detail) use ($stockOut) {
                    return [
                        'no_trans' => $stockOut->no_trans,
                        'tgl_keluar' => Carbon::parse($stockOut->tgl_keluar)->format('d-m-Y'),
                        'user' => $stockOut->user->name,
                        'spv' => $stockOut->supervisor->name,
                        'nm_brg' => $detail->material->nm_brg,
                        'enginer' => $stockOut->enginer->name,
                        'area' => $detail->area->nm_area,
                        'line' => $detail->line->no_line,
                        'drawing' => $detail->drawing->no_drw,
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
            'Tanggal Keluar',
            'PJ',
            'Supervisor',
            'Nama Material',
            'Request by Enginer',
            'Area',
            'Line',
            'Drawing',
            'Satuan',
            'Jumlah',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}