<?php

namespace App\Imports;

use App\Models\{Employe,Bureau,Unite,Statut,TypeEmp};
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StaffImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $bureau = Bureau::where("nom_bur", "like", "%".$row['bureau']."%")->first();
        $unite = Unite::where("nom_unite", "like", "%".$row['unite']."%")->first();
        $typeEmp = TypeEmp::where("nature", "like", "%".$row['type']."%")->first();
        $statut = Statut::where("nom_stat", "like", "".$row['statut']."%")->first();

        $row['bureau_emp'] = $bureau->id_bur;
        $row['unite_emp'] = $unite->id_unite;
        $row['type_emp'] = $typeEmp->id_nature;
        $row['statut_emp'] = $statut->etat_stat;

       /*  $prefix = substr($row['extension'],0, 2);
        switch($prefix) {
            case "07":
                $lign_dir = "2549"+$row['extension'];
                break;
            case "11":
                $lign_dir = "2549"+$row['extension'];
                break;
            case "15":
                $lign_dir = "2532"+$row['extension'];
                break;
            default:
                $lign_dir = "$prefix";
        }
 */
    
        return new employe([
            'nom_emp'         => $row['nom'],
            'email'           => $row['email'],
            'bureau_emp'      => $row['bureau_emp'],
            'unite_emp'       => $row['unite_emp'],
            'fonction_emp'    => $row['fonction'],
            'extension_emp'   => $row['extension'],
            'ligne_direct'    => $row['ligne'],
            'num_flotte'      => $row['flotte'],
            'id_nature_emp'   => $row['type_emp'],
            'callsign'        => $row['callsign'],
            'statut_emp'      => $row['statut_emp'],

        ]);
    }

  /*   public function model(array $row)
    {
        $row['employee_designation_id'] = HrDesignation::where("name", "like", "%".$row['designation']."%");
        $row['line_manager_id']         = HrEmployee::where("first_name", "like", "%".$row['line_manager']."%");
        $row['employee_job_title_id']   = HrJobTitle::where("name", "like", "%".$row['job_title']."%");

        return new HrEmployee([
            'employee_code'           => $row['employee_code'],
            'email'                   => $row['email'],
            'first_name'              => $row['first_name'],
            'last_name'               => $row['last_name'],
            'line_manager_id'         => $row['line_manager_id'],
            'employee_designation_id' => $row['employee_designation_id'],
            'employee_job_title_id'   => $row['employee_job_title_id'],
        ]);
    } */
}
