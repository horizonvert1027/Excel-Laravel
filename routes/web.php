<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HomeController;

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

Route::get('/',[HomeController::class,'index'])->name('home');

Auth::routes();

//Excel
Route::get('/excel',[ExcelController::class,'index']);
Route::post('/import',[ExcelController::class,'import'])->name('import');
Route::post('/loadExcel',[ExcelController::class,'load'])->name('load');
Route::post('/editExcel',[ExcelController::class,'update'])->name('update');

//Image Upload
Route::post('/image', [ExcelController::class, 'show'])->name('show');
Route::post('/upload', [ExcelController::class, 'store'])->name('store');

