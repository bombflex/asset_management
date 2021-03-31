<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BureauxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\ProductAjaxController;
use App\Http\Controllers\AffectationController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DesaffectationController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\AssetChartController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AccessoireController;
use App\Http\Controllers\FournitureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::resource('asset', AssetController::class);
Route::resource('affectation', AffectationController::class);
Route::resource('desaffectation', DesaffectationController::class);
Route::resource('facture', FactureController::class);
Route::resource('equipements', EquipementController::class);
Route::resource('assettype', AssetTypeController::class);
Route::resource('employe', EmployeController::class);
Route::resource('historique', HistoriqueController::class);
Route::resource('assetchart', AssetChartController::class);
Route::resource('fourniture', FournitureController::class);
Route::resource('accessoire', AccessoireController::class);



Route::post('/auto/getemp',[EmployeesController::class,'getEmployees'])->name('employees.getEmployees');
Route::get('export_asset', [AssetController::class,'export'])->name('export_asset');
Route::post('import_asset', [AssetController::class,'import'])->name('import_asset');

Route::get('export_staff', [EmployeController::class,'export'])->name('export_staff');
Route::post('import_staff', [EmployeController::class,'import'])->name('import_staff');

Route::get('check_affect/{invent_num}',[AffectationController::class,'checkAffectation'])->name('affectation.check');
Route::post('completeemp',[AffectationController::class,'autocompleteEmployes'])->name('completeemp');
Route::post('completelaptop',[AffectationController::class,'autocompleteLaptops'])->name('completelaptop');
Route::post('completevhf',[AffectationController::class,'autocompleteVHF'])->name('completevhf');
Route::post('completephone',[AffectationController::class,'autocompletePhone'])->name('completephone');
Route::post('completeasset',[AffectationController::class,'autocompleteasset'])->name('completeasset');
Route::post('completeunite',[EmployeController::class,'autocompleteUnite'])->name('completeunite');
Route::post('completebureau',[EmployeController::class,'autocompleteBureau'])->name('completebureau');
Route::post('completeprest',[FactureController::class,'autocompleteprest'])->name('completeprest');
Route::post('completeaccess',[FournitureController::class,'autocompleteaccessoire'])->name('completeaccess');
Route::get('check_stock/{id}',[FournitureController::class,'checkStock'])->name('fourniture.check');


Route::get('details', [FactureController::class, 'detFacture'])->name('details');

Route::get('students/list', [StudentController::class, 'getStudents'])->name('students.list');
Route::get('ajaxproducts',[ProductAjaxController::class,'index']);
Route::get('autocomplete',[ProductAjaxController::class,'autocomplete'])->name('autocomplete');

Route::get('/auto',[EmployeesController::class, 'index']);

Route::get('export', [UserController::class,'export'])->name('export');
Route::get('importExportView', [UserController::class,'importExportView']);
Route::post('import', [UserController::class,'import'])->name('import');


