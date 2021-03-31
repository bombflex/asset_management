<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Employe;
use App\Models\{Bureau,Employe,Section,Unite,HistoLaptop,Asset};
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Exports\StaffExport;
use App\Imports\StaffImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
//use App\Models\Section;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        /* $employes = Employe::all();
        return view('test', ['employes'=>$employes]); */
        //return $employes;

        $employes = DB::table('employes')
        ->join('bureau', 'employes.bureau_emp', '=', 'bureau.id_bur')
        ->join('unites', 'employes.unite_emp', '=', 'unites.id_unite')
        ->get();
        //return $employes;
        if ($request->ajax()) {
            //$data = Employe::latest()->get();
            return Datatables::of($employes)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" data-toggle="modal"  class="btn editbtn btn-success btn-sm fas fa-eye viewEmploye" 
                        data-id="'.$row->id_emp.'"></button>';

                        $btn .= '<button type="button" data-toggle="modal"  class="btn editbtn btn-primary btn-sm fa fa-edit editEmploye" 
                        data-id="'.$row->id_emp.'"></button>';
                   
                    return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('employes/employe');
        //return $employes;
    }

    public function autocompleteUnite(Request $request){

        $search = $request->search;
  
        if($search == ''){
           $unite = Unite::orderby('nom_unite','asc')
            ->select('id_unite','nom_unite','nom_sect')
            ->join('sections','sections.id_sect','=','unites.id_section')
            ->limit(5)
            ->get();
        }else{
            $unite = Unite::orderby('nom_unite','asc')
            ->select('id_unite','nom_unite','nom_sect')
            ->join('sections','sections.id_sect','=','unites.id_section')
            ->where('nom_unite', 'like', '%' .$search . '%')
            ->limit(5)
            ->get();
        }
  
        $response = array();
        foreach($unite as $item){
           $response[] = array("label"=>$item->nom_unite,"value"=>$item->id_unite,"section"=>$item->nom_sect);
        }
  
        return response()->json($response);
     }
    
     public function autocompleteBureau(Request $request){

        $search = $request->search;
  
        if($search == ''){
           $bureau = Bureau::orderby('nom_bur','asc')
            ->select('id_bur','nom_bur')
            ->limit(10)
            ->get();
        }else{
            $bureau = Bureau::orderby('nom_bur','asc')
            ->select('id_bur','nom_bur')
            ->where('nom_bur', 'like', '%' .$search . '%')
            ->limit(5)
            ->get();
        }
  
        $response = array();
        foreach($bureau as $item){
           $response[] = array("label"=>$item->nom_bur,"value"=>$item->id_bur);
        }
  
        return response()->json($response);
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bureau = Bureau::select('id_bur','nom_bur')
        ->orderBy('nom_bur','asc')
        ->get();

    $section = Section::select('id_sect','nom_sect')
        ->orderBy('nom_sect','asc')
        ->get();

    $asset = Asset::select('id_asset', 'inventory_num', 'asset_description')
        ->orderBy('inventory_num','asc')
        ->get();

    $unite = Unite::select('id_unite','nom_unite')
        ->orderBy('nom_unite','asc')
        ->get();

    return view('employes/add_employe') 
        ->with (compact('section'))
        ->with(compact('bureau'))
        ->with(compact('asset'))
        ->with (compact('unite'));
    return view('employes/add_employe');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->input();
        //Employes
        $employe = new Employe;
        $employe->nom_emp = $request->input('nom');
        $employe->email = $request->input('email');
        $employe->bureau_emp = $request->input('bureau_val');
        $employe->unite_emp = $request->input('unite_val');
        $employe->fonction_emp = $request->input('fonction');
        $employe->extension_emp = $request->input('extension');
        $employe->ligne_direct = $request->input('lgn_direct');
        $employe->num_flotte = $request->input('num_flotte');
        $employe->num_telmob = $request->input('num_telmob');
        $employe->num_autre = $request->input('num_autre');
        $employe->id_nature_emp = $request->input('nature_emp');
        $employe->Comment_emp = $request->input('emp_comment');
        $employe->statut_emp = "1"; //1=Actif,0=Désactivé
        $employe->save();

        return redirect('employe')->with('Ok_Message','ok');
       /*  //Employe
        $info_emp = Employe::all()->where('email',$request->input('email'));
        foreach ($info_emp as $item)
        {
            $id_emp = $item->id;
        }
        //Assets
        $info_asset = Asset::all()->where('inventory_num',"8180032");
        foreach ($info_asset as $item)
        {
            $h_laptop->id_employe = $id_emp;
            $h_laptop->asset_type = $item->asset_type;
            $h_laptop->inventory_code = $item->inventory_code;
            $h_laptop->inventory_num = $item->inventory_num;
            $h_laptop->asset_description = $item->asset_description;
            $h_laptop->serial_num = $item->serial_num ;
            $h_laptop->asset_PO = $item->asset_PO ;
            $h_laptop->PO_date = $item->PO_date ;
            $h_laptop->asset_comment = $item->asset_comment ;
        } */

       /*  $h_laptop->save();
        return redirect('employe'); */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employes = DB::table('employes')
        ->join('natureEmp','natureEmp.id_nature','=','employes.id_nature_emp')
        ->join('bureau', 'employes.bureau_emp', '=', 'bureau.id_bur')
        ->join('unites', 'employes.unite_emp', '=', 'unites.id_unite')
        ->join('sections','sections.id_sect','=','unites.id_section')
        ->where('employes.id_emp',$id)
        ->get();
        return $employes;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return $request->input();
        //Employes
        $emp_id = $request->input('m_id');
        $employe = Employe::find($emp_id);
        $employe->nom_emp = $request->input('m_nom');
        $employe->email = $request->input('m_email');
        $employe->num_flotte = $request->input('m_num_flotte');
        $employe->extension_emp = $request->input('m_extension');
        $employe->ligne_direct = $request->input('m_lgn_direct');
        $employe->num_telmob = $request->input('m_num_telmob');
        $employe->num_autre = $request->input('m_num_autre');
        $employe->statut_emp = $request->input('statut');
        $employe->Comment_emp = $request->input('m_emp_comment');
        $employe->save();

        return redirect('employe')->with('Ok_Message','ok');
    }

    public function export() 
    {
        return Excel::download(new StaffExport, 'Staff.xlsx');
    }
   
    public function import() 
    {
        Excel::import(new StaffImport,request()->file('file'));
           
        return redirect()->back()->with('Ok_Message','ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getEmployes(Request $request)
    {
        if ($request->ajax()) {
            $data = Employe::latest()->get();
            return $data
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

   /* public function listSections(Request $request)
    {
        $sections = Section::select('id','nom')
            ->orderBy('nom','asc')
            ->get();
        return view('employes/add_employe', compact('sections'));
    }

     public function dropdownList(Request $request)
    {
        $bureau = Bureau::select('id','nom')
            ->orderBy('nom','asc')
            ->get();

        $departement = Departement::select('id','nom')
            ->orderBy('nom','asc')
            ->get();

        $asset = Asset::select('id', 'inventory_num', 'asset_description')
            ->orderBy('inventory_num','asc')
            ->get();

        $section = Section::select('id','nom')
            ->orderBy('nom','asc')
            ->get();

        return view('employes/add_employe') 
            ->with (compact('section'))
            ->with(compact('bureau'))
            ->with(compact('asset'))
            ->with (compact('departement'));
    } */

}
