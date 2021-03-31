<?php

namespace App\Exports;

use App\Models\Employe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class StaffExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $employes = Employe::orderby('nom_emp','asc')
        ->select('nom_emp','email','nom_bur','nom_unite','fonction_emp','extension_emp','ligne_direct','num_flotte','nature','callsign','nom_stat')
        ->join('bureau', 'employes.bureau_emp', '=', 'bureau.id_bur')
        ->join('unites', 'employes.unite_emp', '=', 'unites.id_unite')
        ->join('statut','statut.etat_stat','=','employes.statut_emp')
        ->join('natureEmp','natureEmp.id_nature','=','employes.id_nature_emp')
        ->get();
        //return Employe::all();
        return $employes;
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Email', 
            'Bureau', 
            'Unité',
            'Fonction',
            'Extension',
            'Ligne Directe',
            'Flotte',
            'Type',
            'CallSign',
            'Statut',
        ];
    }
}
