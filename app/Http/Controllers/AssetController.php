<?php

namespace App\Http\Controllers;
use App\Models\{Asset,AssetType};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Exports\AssetExport;
use App\Imports\AssetImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;



class AssetController extends Controller

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
                ->join('asset_type', 'assets.asset_type', '=', 'asset_type.id')
                ->get();
        if ($request->ajax()) {
            //$assets = Product::latest()->get();
            return Datatables::of($assets)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '<button type="button" data-toggle="modal"  class="btn editbtn btn-primary btn-sm fa fa-edit editAsset" 
                            data-id="'.$row->id_asset.'"></button>';
                            $btn = $btn.'<button type="button" data-toggle="modal" data-target="#delete_asset" class="btn btn-danger btn-sm fa fa-trash-alt delAsset" 
                            data-id="'.$row->id_asset.'"></button>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        //return $assets;
        return view('assets/asset')
            ->with(compact('asset_type'));

        
    }
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /*   */
        $asset = new Asset;
        $asset->asset_type = $request->asset_type;
        $asset->inventory_code = $request->asset_code;
        $asset->inventory_num = $request->asset_invent;
        $asset->asset_description = $request->asset_desc;
        $asset->serial_num  = $request->asset_serial;
        $asset->asset_PO  = $request->purch_order;
        $asset->PO_date  = $request->purch_order_date;
        $asset->asset_comment = $request->asset_comment;
        
        $asset->save();
        //qw
        return redirect('asset')->with('Ok_Message','ok');

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
        $product = DB::table('assets')
            ->join('asset_type', 'assets.asset_type', '=', 'asset_type.id')
            ->where('assets.id_asset',$id)
            ->orwhere('inventory_num',$id) 
            ->get();

        // return response()->json($product);
        return $product;
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
        $asset_id = $request->input('m_asset_id');
        $asset = Asset::find($asset_id);
        $asset->asset_type = $request->type_id;
        $asset->inventory_code = $request->asset_code;
        $asset->inventory_num = $request->asset_invent;
        $asset->asset_description = $request->asset_desc;
        $asset->serial_num  = $request->asset_serial;
        $asset->asset_PO  = $request->purch_order;
        $asset->PO_date  = $request->purch_order_date;
        $asset->asset_comment = $request->asset_comment;
        
        $asset->save();
        //return $request->input();
        return redirect('asset')->with('Ok_Message','ok');
    }

    public function export() 
    {
        return Excel::download(new AssetExport, 'Assets.xlsx');
    }
   
    public function import() 
    {
        Excel::import(new AssetImport,request()->file('file'));
           
        return redirect()->back()->with('Ok_Message','ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $asset_id = $request->input('d_asset_id');
        $asset = Asset::find($asset_id);
        $asset->delete();
        return redirect('asset')->with('Ok_Message','ok');
        //return $request;
    }

}