<?php

namespace App\Http\Controllers;

use App\Models\Accessoire;
use App\Models\Fourniture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class AccessoireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
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
        $accessoire = new Accessoire;
        $accessoire->access_description = $request->input('access_desc');
        $accessoire->access_quantite = $request->input('acces_qte');
        $accessoire->access_stock = $request->input('acces_qte');
        $accessoire->comment_access = $request->input('access_comment');

        $accessoire->save();

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
        DB::table('accessoires')
            ->where('id_access',$request->input('m_id_access'))
            ->increment('access_quantite',$request->input('acces_qte'));

        DB::table('accessoires')
            ->where('id_access',$request->input('m_id_access'))
            ->increment('access_stock',$request->input('acces_qte'));
        
        return redirect('fourniture')->with('Ok_Message','ok');
        
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
        
    }
}
