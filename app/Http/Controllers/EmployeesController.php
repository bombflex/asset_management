<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use PDF;

class EmployeesController extends Controller
{
  /*  public function index(){
      return view('test');
   } */

   public function index(Request $request)
   {
   $user = Employees::all();
   
 
   $pdf = PDF::loadView('test',compact('user'))->setOptions(['defaultFont' => 'sans-serif']);
   return $pdf->stream();
   //return $pdf->download('pdfview.pdf');

   }


   /*
   AJAX request
   */
   public function getEmployees(Request $request){

      $search = $request->search;

      if($search == ''){
         $employees = Employees::orderby('name','asc')->select('id','name')->limit(5)->get();
      }else{
         $employees = Employees::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
      }

      $response = array();
      foreach($employees as $employee){
         $response[] = array("value"=>$employee->id,"label"=>$employee->name);
      }

      return response()->json($response);
   }
}