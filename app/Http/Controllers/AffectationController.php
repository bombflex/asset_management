<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use App\Models\Employe;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use PDF;
use Mail;


class AffectationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $affectations = DB::table('affectations')
        ->join('employes', 'affectations.id_emp', '=', 'employes.id_emp')
        ->get(); 

        //$affectations = Affectation::latest()->get();
        if ($request->ajax()) {
            
            return Datatables::of($affectations)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '<button type="button" data-toggle="modal" class="btn editbtn btn-success btn-sm fas fa-eye  viewAffect" 
                            data-id="'.$row->id_affect.'"data-nom_emp="'.$row->nom_emp.'"></button>';
                            $btn = $btn.'<button type="button" data-toggle="modal"class="btn btn-primary btn-sm fa fa-edit editAffect" 
                            data-id="'.$row->id_affect.'"></button>';
                            $btn = $btn.'<button type="button" data-toggle="modal" class="btn btn-danger btn-sm fa fa-trash-alt delAffect" 
                            data-id="'.$row->id_affect.'"></button>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        //return $affectations;
        return view('affectations/affectation');
    }

    public function autocompleteEmployes(Request $request){

        $search = $request->search;
  
        if($search == ''){
           $employe = Employe::orderby('nom_emp','asc')
            ->select('id_emp','nom_emp','fonction_emp','nom_unite','nom_bur','nom_sect')
            ->join('unites','unites.id_unite', '=', 'employes.unite_emp')
            ->join('sections', 'sections.id_sect', '=', 'unites.id_section')
            ->join('bureau','bureau.id_bur','=', 'employes.bureau_emp')
            ->limit(5)
            ->get();
        }else{
           $employe = Employe::orderby('nom_emp','asc')
            ->select('id_emp','nom_emp','fonction_emp','nom_unite','nom_bur','nom_sect')
            ->join('unites','unites.id_unite', '=', 'employes.unite_emp')
            ->join('sections', 'sections.id_sect', '=', 'unites.id_section')
            ->join('bureau','bureau.id_bur','=', 'employes.bureau_emp')
            ->where('nom_emp', 'like', '%' .$search . '%')
            ->limit(5)
            ->get();
        }
  
        $response = array();
        foreach($employe as $item){
           $response[] = array("id"=>$item->id_emp, "label"=>$item->nom_emp,
            "value"=>$item->fonction_emp,"dep"=>$item->nom_unite,"bur"=>$item->nom_bur,'sect'=>$item->nom_sect);
        }
  
        return response()->json($response);
     }

    public function autocompleteLaptops(Request $request){

        $search = $request->search;
  
        if($search == ''){
            $laptop = Asset::select('inventory_num','asset_description','serial_num')
            ->where("asset_type",1)
            ->where("affect_id",null)
            ->limit(5)
            ->orderby('inventory_num','asc')
            ->get();

        }else{
            $laptop = Asset::select('inventory_num','asset_description','serial_num')
            ->where("asset_type",1)
            ->where("affect_id",null)
            ->where('inventory_num', 'like', '%' .$search . '%')
            ->orderby('inventory_num','asc')
            ->get();
        }
  
        $response = array();
        foreach($laptop as $item){
           $response[] = array("label"=>$item->inventory_num,"value"=>$item->asset_description,"serial"=>$item->serial_num);
        }
  
        return response()->json($response);
     }
    
    public function autocompleteVHF(Request $request){

        $search = $request->search;
  
        if($search == ''){
            $vhf = Asset::select('inventory_num','asset_description','serial_num')
            ->where("asset_type",2)
            ->where("affect_id",null)
            ->limit(5)
            ->orderby('inventory_num','asc')
            ->get();

        }else{
            $vhf = Asset::select('inventory_num','asset_description','serial_num')
            ->where("asset_type",2)
            ->where("affect_id",null)
            ->where('inventory_num', 'like', '%' .$search . '%')
            ->orderby('inventory_num','asc')
            ->get();
        }
  
        $response = array();
        foreach($vhf as $item){
           $response[] = array("label"=>$item->inventory_num,"value"=>$item->asset_description,"serial"=>$item->serial_num) ;
        }
  
        return response()->json($response);
     }
     
    public function autocompletePhone(Request $request){

        $search = $request->search;
  
        if($search == ''){
            $phone = Asset::select('inventory_num','asset_description','serial_num')
            ->where("asset_type",3)
            ->where("affect_id",null)
            ->limit(5)
            ->orderby('inventory_num','asc')
            ->get();

        }else{
            $phone = Asset::select('inventory_num','asset_description','serial_num')
            ->where("asset_type",3)
            ->where("affect_id",null)
            ->where('inventory_num', 'like', '%' .$search . '%')
            ->orderby('inventory_num','asc')
            ->get();
        }
  
        $response = array();
        foreach($phone as $item){
           $response[] = array("label"=>$item->inventory_num,"value"=>$item->asset_description,"serial"=>$item->serial_num);
        }
  
        return response()->json($response);
     }

    public function autocompleteasset(Request $request){

        $search = $request->search;
  
        if($search == ''){
            $assets = Asset::select('id_asset','inventory_num','asset_description','asset_type','type_description','serial_num','asset_po','po_date')
                ->join('asset_type', 'asset_type.id', '=', 'assets.asset_type')
                ->where("asset_type", '>', 3)
                ->where("emp_id",null)
                ->limit(5)
                ->orderby('inventory_num','asc')
                ->get();

        }else{
            $assets = Asset::select('id_asset','inventory_num','asset_description', 'asset_type','type_description','serial_num','asset_po','po_date')
                ->where("asset_type", '>', 3)
                ->where("emp_id",null)
                ->where('inventory_num', 'like', '%' .$search . '%')
                ->orderby('inventory_num','asc')
                ->get();
            }
  
        $response = array();
        foreach($assets as $item){
           $response[] = array("label"=>$item->inventory_num,"value"=>$item->asset_description,'type'=>$item->type_description
           ,'asset_type'=>$item->asset_type, "serial"=>$item->serial_num,'purch'=>$item->asset_po,'po_date'=>$item->po_date, 'id_asset'=>$item->id_asset);
        }
  
        return response()->json($response);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->query();
        $affectations = DB::table('employes')
        ->join('unites','unites.id_unite','employes.unite_emp')
        ->join('affectations', 'affectations.id_emp', '=', 'employes.id_emp')
        ->where('affectations.id_affect',$id)
        ->get();
        //return $affectations;

        //This is the main document in  Template.docx file.
        $fileName = "template_decharge.docx";
        $filePath = storage_path('app/public/decharges/' . $fileName);

        $phpword = new \PhpOffice\PhpWord\TemplateProcessor($filePath);

        foreach ($affectations as $affectation) {
            $nom = $affectation->nom_emp;
            $fonction = $affectation->fonction_emp;
            $section = $affectation->nom_unite;
            $email = $affectation->email;
            $date_affect = $affectation->created_at;
            
            $desc_lap = $affectation->desc_laptop;
            $nom_lap = $affectation->nom_laptop;
            $serial_lap = $affectation->serial_laptop;
            $inv_lap = $affectation->inv_laptop;
            
            $desc_vhf = $affectation->desc_radio;
            $callsign = $affectation->call_radio;
            $serial_vhf = $affectation->serial_radio;
            $inv_vhf = $affectation->inv_radio;
            
            $desc_phone = $affectation->desc_phone;
            $num_phone = $affectation->numero_phone;
            $serial_phone = $affectation->serial_phone;
            $inv_phone = $affectation->inv_phone;
            }
            
        /* $nom = $request->input('nom_emp');
        $fonction = $request->input('fonction_emp');
        $section = $request->input('nom_unite');
        $email = $request->input('v_email_emp');
        $date_affect = $request->input('created_at'); */
        //return $email;
        $phpword->setValue('nom_emp', $nom);
        $phpword->setValue('fonction', $fonction);
        $phpword->setValue('section', $section);
        $phpword->setValue('date_affect', $date_affect);

        // Laptop
        $phpword->setValue('desc_lap',$desc_lap);
        $phpword->setValue('nom_lap',$nom_lap);
        $phpword->setValue('serial_lap',$serial_lap);
        $phpword->setValue('inv_lap',$inv_lap);

        // Radio
        $phpword->setValue('desc_vhf',$desc_vhf);
        $phpword->setValue('callsign',$callsign);
        $phpword->setValue('serial_vhf',$serial_vhf);
        $phpword->setValue('inv_vhf',$inv_vhf);

        // Radio
        $phpword->setValue('desc_phone',$desc_phone);
        $phpword->setValue('num_phone',$num_phone);
        $phpword->setValue('serial_phone',$serial_phone);
        $phpword->setValue('inv_phone',$inv_phone);

        //return $nom;
        $outputFile = storage_path('app/public/decharges/Decharge_' .$nom. '.docx');

        try{
            $phpword->saveAs($outputFile);
        }catch (Exception $e){
            //handle exception
        }
        return response()->download($outputFile);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $affectation = new Affectation;
        $affectation->id_emp = $request->input('id_emp');
        $affectation->inv_laptop = $request->input('invent_lap');
        $affectation->desc_laptop = $request->input('desc_lap');
        $affectation->serial_laptop = $request->input('serial_lap');
        $affectation->nom_laptop = $request->input('nom_lap');
        $affectation->inv_radio = $request->input('invent_vhf');
        $affectation->desc_radio = $request->input('desc_vhf');
        $affectation->serial_radio = $request->input('serial_vhf');
        $affectation->call_radio = $request->input('callsign');
        $affectation->inv_phone = $request->input('invent_phone');
        $affectation->desc_phone = $request->input('desc_phone');
        $affectation->serial_phone = $request->input('serial_phone');
        $affectation->sim_phone = $request->input('sim_phone');
        $affectation->numero_phone = $request->input('num_tel');
        $affectation->comment_affect = $request->input('affect_comment');

        $affectation->save();
        //$affectation_id = $affectation->id_affect;

        // Update the value of CallSign if not exist
        Employe::where('id_emp',$request->input('id_emp'))
            ->update(array('callsign' => $request->input('callsign')));

        // Update Assets with Employee Id
        Asset::where('inventory_num',$request->input('invent_lap'))
            ->update([
                    'emp_id' => $request->input('id_emp'),
                    'affect_id' => $affectation->id_affect,
                    'affect_date' => date("Y-m-d")
                    ]); 

        Asset::where('inventory_num',$request->input('invent_vhf'))
            ->update([
                    'emp_id' => $request->input('id_emp'),
                    'affect_id' => $affectation->id_affect,
                    'affect_date' => date("Y-m-d")
                    ]);

        Asset::where('inventory_num',$request->input('invent_phone'))
            ->update([
                    'emp_id' => $request->input('id_emp'),
                    'affect_id' => $affectation->id_affect,
                    'affect_date' => date("Y-m-d")
                    ]); 

        return redirect('affectation')->with('Ok_Message','ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->input('v_affect_id');
        $affectations = DB::table('employes')
        ->join('unites','unites.id_unite','employes.unite_emp')
        ->join('affectations', 'affectations.id_emp', '=', 'employes.id_emp')
        ->where('affectations.id_affect',$id)
        ->get();
        //return $affectations;
        //This is the main document in  Template.docx file.
        $fileName = "template_decharge.docx";
        $filePath = storage_path('app/public/decharges/' . $fileName);

        $phpword = new \PhpOffice\PhpWord\TemplateProcessor($filePath);

        foreach ($affectations as $affectation) {
            $nom = $affectation->nom_emp;
            $fonction = $affectation->fonction_emp;
            $section = $affectation->nom_unite;
            $email = $affectation->email;
            $date_affect = $affectation->created_at;
            
            $desc_lap = $affectation->desc_laptop;
            $nom_lap = $affectation->nom_laptop;
            $serial_lap = $affectation->serial_laptop;
            $inv_lap = $affectation->inv_laptop;
            
            $desc_vhf = $affectation->desc_radio;
            $callsign = $affectation->call_radio;
            $serial_vhf = $affectation->serial_radio;
            $inv_vhf = $affectation->inv_radio;
            
            $desc_phone = $affectation->desc_phone;
            $num_phone = $affectation->numero_phone;
            $serial_phone = $affectation->serial_phone;
            $inv_phone = $affectation->inv_phone;
            }
            
        /* $nom = $request->input('nom_emp');
        $fonction = $request->input('fonction_emp');
        $section = $request->input('nom_unite');
        $email = $request->input('v_email_emp');
        $date_affect = $request->input('created_at'); */
        //return $email;
        $phpword->setValue('nom_emp', $nom);
        $phpword->setValue('fonction', $fonction);
        $phpword->setValue('section', $section);
        $phpword->setValue('date_affect', $date_affect);

        // Laptop
        $phpword->setValue('desc_lap',$desc_lap);
        $phpword->setValue('nom_lap',$nom_lap);
        $phpword->setValue('serial_lap',$serial_lap);
        $phpword->setValue('inv_lap',$inv_lap);

        // Radio
        $phpword->setValue('desc_vhf',$desc_vhf);
        $phpword->setValue('callsign',$callsign);
        $phpword->setValue('serial_vhf',$serial_vhf);
        $phpword->setValue('inv_vhf',$inv_vhf);

        // Radio
        $phpword->setValue('desc_phone',$desc_phone);
        $phpword->setValue('num_phone',$num_phone);
        $phpword->setValue('serial_phone',$serial_phone);
        $phpword->setValue('inv_phone',$inv_phone);


        //return $nom;
        $outputFile = storage_path('app/public/decharges/Decharge_' .$nom. '.docx');

        try{
            $phpword->saveAs($outputFile);
        }catch (Exception $e){
            //handle exception
        }
        $body = "Bonjour , ci-joint la décharge!";

        $contactName = $nom;
        $contactEmail = $email;
        $contactMessage = "Bonjour ".$contactName." , ci-joint la décharge!";

        $data = array('name'=>$contactName, 'email'=>$contactEmail, 'message'=>$contactMessage);

        Mail::send([], $data, function($message) use ($contactEmail, $contactName, $outputFile)
        {   
            $message->to($contactEmail, $contactName)
                ->subject('Décharge Materiel ICT')
                ->attach($outputFile);
            
                $message->setBody('<p>Bonjour '.$contactName.',<br><br>Ci-joint la décharge!<br><br>Merci</p>', 'text/html');

        });
        return redirect('affectation')->with('Ok_Message','ok');
        //dd('Mail sent successfully');
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
        ->join('affectations','affectations.id_emp','=','employes.id_emp')
        /* ->join('assets','assets.affect_id','=','affectations.id_affect') */
        ->where('affectations.id_affect',$id)
        ->get();

        // return response()->json($product);
        return $infos;
    }
    
    public function checkAffectation($invent)
    {
        $asset = Asset::select('inventory_num','asset_description','serial_num','nom_emp')
            ->join('employes', 'assets.emp_id', '=', 'employes.id_emp')
            ->where('assets.inventory_num', $invent)
            ->get();
            
        return $asset;
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
        $affect_id = $request->input('m_affect_id');
        $affectation = Affectation::find($affect_id);
        /* $affectation->id_emp = $request->input('id_emp');*/
        $affectation->inv_laptop = $request->input('m_invent_lap');
        $affectation->desc_laptop = $request->input('m_desc_lap');
        $affectation->serial_laptop = $request->input('m_serial_lap'); 
        $affectation->nom_laptop = $request->input('m_nom_lap');
        $affectation->inv_radio = $request->input('m_invent_vhf');
        $affectation->desc_radio = $request->input('m_desc_vhf');
        $affectation->serial_radio = $request->input('m_serial_vhf');
        $affectation->call_radio = $request->input('m_callsign');
        $affectation->inv_phone = $request->input('m_invent_phone');
        $affectation->desc_phone = $request->input('m_desc_phone');
        $affectation->serial_phone = $request->input('m_serial_phone'); 
        $affectation->sim_phone = $request->input('m_sim_phone');
        $affectation->numero_phone = $request->input('m_num_tel');
        $affectation->comment_affect = $request->input('m_affect_comment');

        //return $request->input();
        // Copy the raw into Histo_Affectation before update
        DB::insert("insert into Histo_Affectations (id_emp, inv_laptop, desc_laptop, serial_laptop, nom_laptop, inv_radio, desc_radio, 
                serial_radio, call_radio, inv_phone, desc_phone, serial_phone, sim_phone, numero_phone, created_at) 
                select id_emp, inv_laptop, desc_laptop, serial_laptop, nom_laptop, inv_radio, desc_radio, serial_radio, call_radio, inv_phone, 
                desc_phone, serial_phone, sim_phone, numero_phone, ?
                From Affectations 
                Where inv_laptop = ? OR  inv_radio = ? OR  inv_phone = ?", [ date("Y-m-d"), $request->input('m_invent_lap'), $request->input('m_invent_vhf'), $request->input('m_invent_phone')] );
       
        $affectation->save();
        
        // Update the value of CallSign if changed
        Employe::where('id_emp',$request->input('m_id_emp'))
            ->update(array('callsign'=>$request->input('m_callsign')));

        // Update Assets with Employee Id
        Asset::where('inventory_num',$request->input('m_invent_lap'))
            ->update([
                    'emp_id' => $request->input('m_id_emp'),
                    'affect_id' => $affectation->id_affect,
                    'affect_date' => date("Y-m-d")
                    ]); 

        Asset::where('inventory_num',$request->input('m_invent_lap_old'))
                    ->update([
                            'emp_id' => null,
                            'affect_id' => null,
                            'affect_date' => null
                            ]); 

        Asset::where('inventory_num',$request->input('m_invent_vhf'))
            ->update([
                    'emp_id' => $request->input('m_id_emp'),
                    'affect_id' => $affectation->id_affect,
                    'affect_date' => date("Y-m-d")
                    ]);

        Asset::where('inventory_num',$request->input('m_invent_vhf_old'))
        ->update([
                'emp_id' => null,
                'affect_id' => null,
                'affect_date' => null
                ]); 

        Asset::where('inventory_num',$request->input('m_invent_phone'))
            ->update([
                    'emp_id' => $request->input('m_id_emp'),
                    'affect_id' => $affectation->id_affect,
                    'affect_date' => date("Y-m-d")
                    ]); 
        Asset::where('inventory_num',$request->input('m_invent_phone_old'))
        ->update([
                'emp_id' => null,
                'affect_id' => null,
                'affect_date' => null
                ]);

        
        return redirect('affectation')->with('Ok_Message','ok');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::insert("insert into Histo_Affectations (id_emp, inv_laptop, desc_laptop, serial_laptop, nom_laptop, inv_radio, desc_radio, 
        serial_radio, call_radio, inv_phone, desc_phone, serial_phone, sim_phone, numero_phone, created_at) 
        select id_emp, inv_laptop, desc_laptop, serial_laptop, nom_laptop, inv_radio, desc_radio, serial_radio, call_radio, inv_phone, 
        desc_phone, serial_phone, sim_phone, numero_phone, ? from Affectations where id_affect = ?", [ date("Y-m-d"), $request->input('d_affect_id')]);


        $affect_id = $request->input('d_affect_id');
        $affectation = Affectation::find($affect_id);
        $affectation->delete();

        Asset::where('inventory_num',$request->input('m_invent_lap_del'))
                    ->update([
                            'emp_id' => null,
                            'affect_id' => null,
                            'affect_date' => null
                            ]); 

        Asset::where('inventory_num',$request->input('m_invent_vhf_del'))
        ->update([
                'emp_id' => null,
                'affect_id' => null,
                'affect_date' => null
                ]);
        
        Asset::where('inventory_num',$request->input('m_invent_phone_del'))
        ->update([
                'emp_id' => null,
                'affect_id' => null,
                'affect_date' => null
                ]);
        return redirect('affectation')->with('Ok_Message','ok');
    }
}
