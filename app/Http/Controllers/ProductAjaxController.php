<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;



class ProductAjaxController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //$assets = Product::select('inventory_code')->get();
        return view('teste');

        
    }

    public function autocomplete(Request $request)
    {
        $code = $request->input('query');
        $data = Product::select("inventory_code")
            ->where("inventory_code","LIKE","%{$code}%")
            ->get();

            $dat = array();
            foreach ($data as $hsl)
                {
                    $dat[] = $hsl->inventory_code;
                }
   
        return response()->json($dat);
        //return $request->input('inventory_code');
    }


   
    

     
    public function edit($id)

    {

        //$product = Product::find($id);
        $product = DB::table('assets')
            ->join('asset_type', 'assets.asset_type', '=', 'asset_type.id')
            ->where('assets.id_asset',$id) 
            ->get();

        // return response()->json($product);
        return $product;

    }




}