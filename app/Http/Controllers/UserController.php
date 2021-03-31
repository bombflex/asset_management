<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserController extends Controller
{
     

    public function importExportView()
    {
       return view('teste');
    }
   
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
   
    public function import() 
    {
        Excel::import(new UsersImport,request()->file('file'));
           
        return redirect()->back();
    }

}