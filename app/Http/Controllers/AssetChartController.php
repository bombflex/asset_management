<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Asset};

use App\Charts\AssetChart;
use Illuminate\Support\Facades\DB;

class AssetChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        $map_affectation = Asset::orderBy('type_description','asc') 
            ->select('type_description','emp_id') 
            ->join('Asset_Type','Asset_Type.id', '=', 'Assets.asset_type')
            ->where('asset_type', '<=',3)
            ->where('emp_id', '<>',null)
            ->get() 
            ->groupBy('type_description') 
            ->map(function ($item){
                return count($item);
            });

        $affectation = Asset::orderBy('asset_description','asc') 
            ->select(array('asset_description', DB::raw('COUNT(asset_description) as qte'))) 
            ->where('asset_type', '<=',3)
            ->where('emp_id', '<>',null)
            ->groupBy('asset_description') 
            ->get(); 

        $map_magasin = Asset::orderBy('type_description','asc') 
            ->select('type_description','emp_id') 
            ->join('Asset_Type','Asset_Type.id', '=', 'Assets.asset_type')
            ->where('asset_type', '<=',3)
            ->where('emp_id', '=',null)
            ->get() 
            ->groupBy('type_description') 
            ->map(function ($item){
                return count($item);
            });

        $magasin = Asset::orderBy('asset_description','asc') 
            ->select(array('asset_description', DB::raw('COUNT(asset_description) as qte'))) 
            ->where('asset_type', '<=',3)
            ->where('emp_id', '=',null)
            ->groupBy('asset_description') 
            ->get(); 


        /* $map_accessoire = DB::table('accessoires') 
            ->select('access_description',DB::raw('access_quantite - access_stock as affect'))
            ->orderBy('access_description', 'asc')
            ->get()    
            ->map(function ($item){
                return count($item);
            }); */
           // return $map_accessoire;
        $accessoire = DB::table('accessoires') 
            ->select('access_description',DB::raw('access_quantite - access_stock as affect'))
            ->orderBy('access_description', 'asc')
            ->get();     

        $d_accessoire = DB::table('accessoires') 
            ->select('access_description','access_stock')
            ->orderBy('access_description', 'asc')
            ->get();       
            
            
        $ch_affectation = new AssetChart;
        $ch_affectation->labels($map_affectation->keys());

        $ch_affectation->dataset('Assets', 'pie', $map_affectation->values())
                        ->backgroundColor('CornflowerBlue');

        $ch_magasin = new AssetChart;
        $ch_magasin->labels($map_magasin->keys());

        $ch_magasin->dataset('Assets', 'pie', $map_magasin->values())
                    ->backgroundColor('Tomato');

        return view ('dashboard/index')
            ->with(compact('ch_affectation','ch_magasin'))
            ->with(compact('affectation','magasin'));
    }
}