<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Bureau,Section};
use Illuminate\Support\Facades\DB;

class BureauxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dutyStation/bureau');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nom = $request->input('lieu');
        $bureau = new Bureau;
        $bureau->nom_bur = $nom;
        //$duty = $request->input('lieu');
        $section = new Section;
        

        $bureau->save();

        $data = Bureau::all()->where('nom_bur',$nom);

        foreach ($data as $item) {
            $id = $item->id;
        }
        $section->nom_unite = $id;
        $section->save();
        //return $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //return Bureau::all();
        //$data = DB::table('bureaux')->get();
        $data = Bureau::all();
        return view('dutyStation/bureaux', ['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Bureau::find($id);
        return view('dutyStation/modifierBureau', ['data'=>$data]);
        //return Bureau::find($id);
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
        //return $request->input();
        $data = Bureau::find($request->id);
        $data->nom_bur = $request->lieu;
        $data->save();
        return redirect('bureaux');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Bureau::find($id);
        $data->delete();
        return redirect('bureaux');
    }
}
