<?php

namespace App\Imports;

use App\Models\{Asset,AssetType};
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssetImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $type = AssetType::where("type_description", "like", "%".$row['type']."%")->first();

        $row['type_asset'] = $type->id;

    
        return new asset([
            'asset_type'            => $row['type_asset'],
            'inventory_num'         => $row['inventaire'],
            'asset_description'     => $row['description'],
            'serial_num'            => $row['serial'],
            'asset_po'              => $row['po'],
            'po_date'               => $row['date'],

        ]);
    }

}
