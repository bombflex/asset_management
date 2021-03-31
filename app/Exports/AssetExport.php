<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class AssetExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $asset = Asset::orderby('inventory_num','asc')
        ->select('type_description','inventory_num','asset_description','serial_num','asset_PO','PO_date')
        ->join('asset_type', 'assets.asset_type', '=', 'asset_type.id')
        ->get();
        //return Employe::all();
        return $asset;
    }

    public function headings(): array
    {
        return [
            'Type',
            '# Inventaire',
            'Description',
            'Serial',
            'P.O',
            'Date',
        ];
    }
}
