<?php

namespace App\Http\Controllers;

use App\Models\Accessoire;
use App\Models\Fourniture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class FournitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accessoires = DB::table('accessoires')
            ->orderBy('access_description','asc')
            ->get();


        $fournitures = DB::table('fournitures')
            ->join('employes', 'fournitures.emp_id', '=', 'employes.id_emp')
            ->join('accessoires','fournitures.access_id', '=', 'accessoires.id_access')
            ->orderBy('employes.nom_emp', 'asc')
            ->get();

        if ($request->ajax()) {
        
            return Datatables::of($fournitures)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '<button type="button" data-toggle="modal" class="btn btn-success btn-sm fas fa-eye "></button>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }   
        //return $accessoires;
        return view('accessoires/accessoire')
            ->with(compact('accessoires'));
    }


    public function autocompleteAccessoire(Request $request){

        $search = $request->search;
  
        if($search == ''){
            $acessoire = DB::table('Accessoires')
            ->limit(5)
            ->orderby('access_description','asc')
            ->get();

        }else{
            $laptop = DB::table('Accessoires')
            ->acessoire('access_description', 'like', '%' .$search . '%')
            ->orderby('access_description','asc')
            ->get();
        }
  
        $response = array();
        foreach($acessoire as $item){
           $response[] = array("label"=>$item->access_description,"value"=>$item->id_access);
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
        //return $request;
        $foutinure = new Fourniture;
        $foutinure->emp_id = $request->input('id_emp');
        $foutinure->access_id = $request->input('id_access');
        $foutinure->quantite = $request->input('qte_acces');
        $foutinure->date_four = $request->input('date_acces');
        $foutinure->comment_four = $request->input('access_comment');

        $foutinure->save();

        // Update the value of Stock
        DB::table('accessoires')
            ->where('id_access',$request->input('id_access'))
            ->decrement('access_stock',$request->input('qte_acces'));

        return redirect('fourniture')->with('Ok_Message','ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $accessoires = DB::table('accessoires')
            ->orderBy('access_description', 'asc')
            ->get();
        
        //return $accessoires;
        return $accessoires;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        
        /* DB::table('accessoires')
            ->where('id_access',$request->input('m_id_access'))
            ->increment('access_quantite',$request->input('acces_qte'));

        DB::table('accessoires')
            ->where('id_access',$request->input('m_id_access'))
            ->increment('access_stock',$request->input('acces_qte'));
        
        return redirect('fourniture')->with('Ok_Message','ok'); */
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

    public function checkStock($id)
    {
        $accessoire = DB::table('Accessoires')
            ->select('access_description','access_stock')
            ->where('id_access', $id)
            ->get();
            
        return $accessoire;
    }
}
