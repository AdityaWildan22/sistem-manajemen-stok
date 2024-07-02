<?php

namespace App\Exports;

use App\Models\Materials;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MaterialExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(DB::table('materials')
        ->join('categories', 'materials.id_cat', '=', 'categories.id')
        ->join('subcategories', 'materials.id_subcat', '=', 'subcategories.id')
        ->select('materials.kd_brg','materials.nm_brg', 'categories.nm_cat', 'subcategories.nm_subcat','materials.size1','materials.size2','materials.thickness1','materials.thickness2','materials.SCH','materials.type1','materials.type2','materials.satuan','materials.stok','materials.specification')
        ->get());
    }

    public function headings(): array
    {
        return [
            'Kode Material',
            'Nama Material',
            'Kategori',
            'Sub Kategori',
            'Size 1',
            'Size 2',
            'Thickness 1',
            'Thickness 2',
            'SCH',
            'Tipe 1',
            'Tipe 2',
            'Satuan',
            'Stok', 
            'Spesifikasi',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:N1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}