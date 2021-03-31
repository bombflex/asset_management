<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bureau extends Model
{
    use HasFactory;
    protected $table = 'bureau';
    protected $primaryKey = 'id_bur';
    //public $timestamps = false;
}
