<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class HistoriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $histo_affectations = DB::table('histo_affectations')
        ->join('employes', 'histo_affectations.id_emp', '=', 'employes.id_emp')
        ->get(); 
        //return $histo_affectations;
        //$affectations = Affectation::latest()->get();
        if ($request->ajax()) {
            
            return Datatables::of($histo_affectations)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '<button type="button" data-toggle="modal" class="btn editbtn btn-success btn-sm fas fa-eye  viewAffect" 
                            data-id="'.$row->id_histo_affect.'"data-nom_emp="'.$row->nom_emp.'"></button>';
                            /* $btn = $btn.'<button type="button" data-toggle="modal"class="btn btn-primary btn-sm fa fa-edit editAffect" 
                            data-id="'.$row->id_affect.'"></button>';
                            $btn = $btn.'<button type="button" data-toggle="modal" class="btn btn-danger btn-sm fa fa-trash-alt delAffect" 
                            data-id="'.$row->id_affect.'"></button>'; */
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        //return $affectations;
        return view('affectations/historique');
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
        //$product = Product::find($id);
        $infos = DB::table('employes')
        ->join('unites','unites.id_unite', '=', 'employes.unite_emp')
        ->join('bureau','bureau.id_bur','=', 'employes.bureau_emp')
        ->join('histo_affectations','histo_affectations.id_emp','=','employes.id_emp')
        /* ->join('assets','assets.affect_id','=','affectations.id_affect') */
        ->where('histo_affectations.id_histo_affect',$id)
        ->get();

        // return response()->json($product);
        return $infos;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
