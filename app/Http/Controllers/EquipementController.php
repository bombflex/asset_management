<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Equipement, Asset};
use Illuminate\Support\Facades\DB;
use DataTables;

class EquipementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $assets = DB::table('equipements') 
            ->join('employes', 'employes.id_emp', '=', 'equipements.emp_id') 
            ->join('bureau', 'id_bur', '=','employes.bureau_emp') 
            ->join('assets','assets.id_asset', '=', 'equipements.asset_id') 
            ->join('asset_type', 'asset_type.id', '=', 'equipements.asset_type') 
            ->get();

            if ($request->ajax()) {
                return Datatables::of($assets)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                                $btn = '<button type="button" data-toggle="modal"  class="viewbtn btn btn-success btn-sm fas fa-eye" 
                                data-id="'.$row->asset_id.'"data-nom_emp="'.$row->nom_emp.'"data-asset="'.$row->asset_type.'"></button>';
                                $btn = $btn.'<button type="button" class="btn editbtn btn-primary btn-sm fa fa-edit" 
                                data-id="'.$row->id_asset.'"data-asset="'.$row->asset_type.'"data-nom_emp="'.$row->nom_emp.'"></button>';
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            //return $assets;
        return view('affectations/equipements');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $equipement = new Equipement;
        $equipement->asset_id = $request->input('id_asset');
        $equipement->asset_type = $request->input('asset_type');
        $equipement->emp_id = $request->input('id_emp');
        $equipement->affect_date = $request->input('affect_date');

        $equipement->save();

        // Update Assets with Employee Id
        Asset::where('id_asset',$request->input('id_asset'))
            ->update([
                    'emp_id' => $request->input('id_emp'),
                    'affect_date' => $request->input('affect_date')
                    ]); 

        return redirect('equipements')->with('Ok_Message','ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assets = DB::table('assets')
            ->join('employes', 'employes.id_emp', '=', 'assets.emp_id')
            ->join('bureau', 'employes.bureau_emp', '=', 'bureau.id_bur')
            ->join('unites', 'employes.unite_emp', '=', 'unites.id_unite')
            ->join('sections','sections.id_sect','=','unites.id_section')
            /* ->join('affectations', 'affectations.id_affect', '=', 'assets.affect_id') */
            ->join('asset_type', 'asset_type.id', '=', 'assets.asset_type')
            ->where('assets.id_asset',$id)
            ->get();
            return $assets;
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
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Create a copy of the affected raw before editing the content
        DB::insert("insert into Histo_Equipements () 
        select * from Equipements where asset_id = ?", [$request->input('v_asset_id')]);

        // Update Asset with informations
        
        Asset::where('id_asset',$request->input('v_asset_id'))
            ->update([
                    'emp_id' => null,
                    'affect_id' => null,
                    'affect_date' => null
                    ]);

        DB::table('equipements')
        ->where('asset_id', $request->input('v_asset_id'))
        ->delete();

        return redirect('equipements')->with('Ok_Message','ok');
    }
}
