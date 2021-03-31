<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Prestatire;
use Illuminate\Support\Facades\DB;
use DataTables;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $devises = DB::table('devises')
            ->get();

        $factures = DB::table('factures')
        ->join('prestataires', 'prestataires.id_prest', '=', 'factures.prest_id')
        ->get(); 

        //$affectations = Affectation::latest()->get();
        if ($request->ajax()) {
            
            return Datatables::of($factures)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '<button type="button" data-toggle="modal" class="btn editbtn btn-success btn-sm fas fa-eye  viewFacture" 
                            data-id="'.$row->id_fact.'" data-num_fact="'.$row->num_fact.'"data-nom_fact="'.$row->nom_fact.'"></button>';
                            $btn = $btn.'<button type="button" data-toggle="modal" class="btn btn-primary btn-sm fa fa-edit editFacture" 
                            data-id="'.$row->id_fact.'"></button>';
                            $btn = $btn.'<button type="button" data-toggle="modal" class="btn btn-danger btn-sm fa fa-trash-alt delFacture" 
                            data-id="'.$row->id_fact.'"></button>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        //return $affectations;
        return view('factures/facture')
            ->with(compact('devises')) ;
    }

    public function autocompleteprest(Request $request){

        $search = $request->search;
  
        if($search == ''){
            $prest = DB::table('prestataires')
            ->orderby('nom_prest','asc')
            ->get();

        }else{
            $prest = DB::table('prestataires')
            ->orderby('nom_prest','asc')
            ->where('nom_prest', 'like', '%' .$search . '%')
            ->get();
        }
  
        $response = array();
        foreach($prest as $item){
           $response[] = array("label"=>$item->nom_prest,"value"=>$item->id_prest) ;
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
       /*  $request->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
            ]); */
        $facture = new Facture;
        
        if ($request->file){
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $facture->nom_fact = $fileName;
            $facture->chemin_fact = '/storage/'. $filePath;
        }
        else {
            $fileName = "";
        }
        $facture->prest_id = $request->input('id_prest');
        $facture->num_fact = $request->input('num_fact');
        $facture->objet_fact = $request->input('obj_fact');
        $facture->date_fact = $request->input('date_fact');
        $facture->montant_fact_cfa = $request->input('mont_fact_cfa');
        $facture->date_trans = $request->input('date_trans');
        $facture->comment_fact = $request->input('fact_comment'); 
        $facture->save();
        
        return redirect('facture')->with('Ok_Message','ok');
        //return $filePath;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showe($id)
    {
        $det_factures = DB::table('detail_factures')
        ->join('factures', 'factures.id_fact', '=', 'detail_factures.fact_id')
        ->where('detail_factures.fact_id',$id)
        ->get(); 

        return $det_factures;
    }
    public function show(Request $request,$id)
    {
        $det_factures = DB::table('detail_factures')
        ->join('factures', 'factures.id_fact', '=', 'detail_factures.fact_id')
        ->where('detail_factures.fact_id',$id)
        ->get(); 

        if ($request->ajax()) {
            
            return Datatables::of($det_factures)
                    ->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $factures = DB::table('factures')
        ->join('prestataires', 'prestataires.id_prest', '=', 'factures.prest_id')
        ->where('factures.id_fact',$id)
        ->get(); 

        return $factures;

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
        

        $fact_id = $request->input('m_id_fact');
        $facture = Facture::find($fact_id);

        if ($request->file){
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $facture->nom_fact = $fileName;
            $facture->chemin_fact = '/storage/'. $filePath;
        }
        else {
            $fileName = "";
        }
        $facture->prest_id = $request->input('m_id_prest');
        $facture->num_fact = $request->input('m_num_fact');
        $facture->objet_fact = $request->input('m_obj_fact');
        $facture->date_fact = $request->input('m_date_fact');
        $facture->montant_fact_cfa = $request->input('m_mont_fact_cfa');
        $facture->date_trans = $request->input('m_date_trans');
        $facture->comment_fact = $request->input('m_fact_comment');
        $facture->save();
        
        return redirect('facture')->with('Ok_Message','ok');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $fact_id = $request->input('d_fact_id');
        $facture = Facture::find($fact_id);
        $facture->delete();
        return redirect('facture')->with('Ok_Message','ok');
        //return $request;
    }
}
