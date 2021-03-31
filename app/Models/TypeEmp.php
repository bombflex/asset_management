<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEmp extends Model
{
    use HasFactory;
    protected $table = 'natureEmp';
    protected $primaryKey = 'id_nature';
    public $timestamps = false;
}
