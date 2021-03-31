<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetType;

class AssetTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asset_type = Assettype::all();
        return view('assets/asset_type', ['asset_type' =>$asset_type]);
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
        $asset_type = new AssetType;
        $asset_type->description = $request->type_desc;
        $asset_type->comment = $request->type_comment;
        
        $asset_type->save();
        //return $request->input();
        return redirect('assettype');
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
        $type_id = $request->input('type_id');
        $asset_type = AssetType::find($type_id);
        $asset_type->description = $request->type_desc;
        $asset_type->comment = $request->type_comment;
        
        $asset_type->save();
        //return $request->input();
        //return $request->input();
        return redirect('assettype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $type_id = $request->input('type_id');
        $type_id = Assettype::find($type_id);
        $type_id->delete();
        return redirect('assettype');
        // return $request->input();
    }
}
