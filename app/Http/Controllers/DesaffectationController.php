<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Asset,AssetType,Affectation};
use Illuminate\Support\Facades\DB;
use DataTables;


class DesaffectationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $asset_type = AssetType::select('id','type_description')
            ->orderBy('type_description','asc')
            ->get(); 

        $assets = DB::table('assets')
                ->join('employes', 'employes.id_emp', '=', 'assets.emp_id')
                /* ->join('affectations', 'affectations.id_affect', '=', 'assets.affect_id') */
                ->join('asset_type', 'asset_type.id', '=', 'assets.asset_type')
                ->where('asset_type', '<=', 3)
                ->get();
        if ($request->ajax()) {
            //$assets = Product::latest()->get();
            return Datatables::of($assets)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '<button type="button" data-toggle="modal"  class="viewbtn btn btn-success btn-sm fas fa-eye" 
                            data-id="'.$row->id_asset.'"data-nom_emp="'.$row->nom_emp.'"data-asset="'.$row->asset_type.'"></button>';
                            /* $btn = $btn.'<button type="button" data-toggle="modal" data-target="#delete_asset" class="delbtn btn btn-danger btn-sm fa fa-trash-alt " 
                            data-id="'.$row->id_asset.'"data-asset="'.$row->asset_type.'"data-inventory="'.$row->inventory_num.'"></button>'; */
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        //return $assets;
        return view('affectations/desaffectation')
            ->with(compact('asset_type'));

        
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
        //
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
    /* public function update(Request $request)
    {
        $asset_id = $request->input('d_asset_id');
        $asset = Asset::find($asset_id);
        // Update Asset with informations

        Asset::where('id_asset',$request->input('d_asset_id'))
            ->update([
                    'emp_id' => '',
                    'affect_id' => '',
                    'affect_date' => ''
                    ]);

        return redirect('asset')->with('Ok_Message','ok');
        //return $request;
    } */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Update Asset with informations
        
        Asset::where('id_asset',$request->input('v_asset_id'))
            ->update([
                    'emp_id' => null,
                    'affect_id' => null,
                    'affect_date' => null
                    ]);
            
            switch ($request->input('v_affect_type')) {
            // Create a copy of the affected raw before editing the content
                case '1': // Laptop
                    DB::insert("insert into Histo_Affectations (id_emp, inv_laptop, desc_laptop, serial_laptop, nom_laptop, inv_radio, desc_radio, 
                    serial_radio, call_radio, inv_thuraya, desc_thuraya, serial_thuraya, sim_thuraya, numero_thuraya, created_at) 
                    select id_emp, inv_laptop, desc_laptop, serial_laptop, nom_laptop, inv_radio, desc_radio, serial_radio, call_radio, inv_thuraya, 
                    desc_thuraya, serial_thuraya, sim_thuraya, numero_thuraya, ? from Affectations where inv_laptop = ?", [ date("Y-m-d"), $request->input('v_asset_invent')]);

                    Affectation::where('inv_laptop',$request->input('v_asset_invent'))
                    ->update([
                            'inv_laptop' => null,
                            'desc_laptop' => null,
                            'nom_laptop' => null,
                            'serial_laptop' => null
                            ]);

                    break;
                case '2': // Radio VHF
                    DB::insert("insert into Histo_Affectations (id_emp, inv_laptop, desc_laptop, serial_laptop, nom_laptop, inv_radio, desc_radio, 
                    serial_radio, call_radio, inv_thuraya, desc_thuraya, serial_thuraya, sim_thuraya, numero_thuraya) 
                    select id_emp, inv_laptop, desc_laptop, serial_laptop, nom_laptop, inv_radio, desc_radio, serial_radio, call_radio, inv_thuraya, 
                    desc_thuraya, serial_thuraya, sim_thuraya, numero_thuraya from Affectations where inv_radio = ?", [$request->input('v_asset_invent')]);

                    Affectation::where('inv_radio',$request->input('v_asset_invent'))
                    ->update([
                            'inv_radio' => null,
                            'desc_radio' => null,
                            'call_radio' => null,
                            'serial_radio' => null
                            ]);
                    break;

                case '3': // Thuraya
                    DB::insert("insert into Histo_Affectations (id_emp, inv_laptop, desc_laptop, serial_laptop, nom_laptop, inv_radio, desc_radio, 
                    serial_radio, call_radio, inv_thuraya, desc_thuraya, serial_thuraya, sim_thuraya, numero_thuraya) 
                    select id_emp, inv_laptop, desc_laptop, serial_laptop, nom_laptop, inv_radio, desc_radio, serial_radio, call_radio, inv_thuraya, 
                    desc_thuraya, serial_thuraya, sim_thuraya, numero_thuraya from Affectations where inv_thuraya = ?", [$request->input('v_asset_invent')]);

                    Affectation::where('inv_thuraya',$request->input('v_asset_invent'))
                    ->update([
                            'inv_thuraya' => null,
                            'desc_thuraya' => null,
                            'serial_thuraya' => null,
                            'sim_thuraya' => null,
                            'numero_thuraya' => null
                            ]);
                    break;
        }
        $assets = DB::table('affectations')
            ->where('id_affect', $request->input('v_affect_id'))
            ->get();

        
        //return redirect('desaffectation')->with('Ok_Message','ok');
        /* foreach ($assets as $asset) {
            if ($asset->inv_thuraya === null) {
                DB::table('affectations')
                    ->where('id_affect', $request->input('v_affect_id'))
                    ->delete();
            }
        } */
        return redirect('desaffectation')->with('Ok_Message','ok');
    }
        
}
