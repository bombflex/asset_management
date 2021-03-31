<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_asset';
    //public $timestamps = false;
    
    protected $fillable = [
        'asset_type',
        'inventory_num',
        'asset_description',
        'serial_num',
        'asset_po',
        'po_date',
    ];
}
