<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::group(['middleware' => ['auth', 'verified']], function() {
});

Route::group(['prefix' => 'admin'], function() 
{ 
    Route::get("/",[EmployeeController::class,'index']);
    Route::get("add",[EmployeeController::class,'create']);
    Route::post("add",[EmployeeController::class,'store']);
    Route::get("edit/{employee}",[EmployeeController::class,'edit']);
    Route::post("update",[EmployeeController::class,'update']);
    Route::get("delete/{employee}",[EmployeeController::class,'destroy']);
    Route::get("leave",[LeaveController::class,'create']);
    Route::post("leave",[LeaveController::class,'store']);
    Route::get("leaves",[LeaveController::class,'index']);
    Route::get("delete-leave/{leave}",[LeaveController::class,'destroy']);


}); 