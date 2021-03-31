<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_emp';
    protected $fillable = [
        'nom_emp',
        'email',
        'bureau_emp',
        'unite_emp', 
        'fonction_emp',
        'extension_emp',
        'ligne_direct',
        'num_flotte',
        'id_nature_emp',    
        'callsign',
        'statut_emp',
    ];
    //public $timestamps = false;
}
