<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;

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



// routes for admin login
Route::view("admin-login","admin/login");
Route::post("admin-login",[UserController::class,'AdminLogin']);

Route::group(['middleware' => ['auth', 'verified']], function() {

Route::group(['prefix' => 'admin'], function() 
{ 
    Route::get("leaves",[LeaveController::class,'index']);
    Route::get("register",[UserController::class,'create']);
    Route::post("register",[UserController::class,'store']);
    Route::get("/",[UserController::class,'index']);
    Route::get("approve/{leave}",[LeaveController::class,'approve']);
    Route::get("delete-leave/{leave}",[LeaveController::class,'DestroyLeave']);
    Route::get("edit-leave/{leave}",[LeaveController::class,'EditLeave']);
    Route::post("update-leave",[LeaveController::class,'UpdateLeave']);
    Route::get("logout",[UserController::class,'destroy']);
    Route::get("delete-employee/{user}",[UserController::class,'delete']);
    Route::get("edit-user/{user}",[UserController::class,'edit']);
    Route::post("Update-Employee",[UserController::class,'UpdateEmployee']);


}); 


Route::group(['prefix' => 'employees'], function() 
{ 
    Route::get("leaves",[LeaveController::class,'UserLeaves']);
    Route::get("leave",[LeaveController::class,'create']);
    Route::post("leave",[LeaveController::class,'store']);
    Route::get("delete-leave/{leave}",[LeaveController::class,'destroy']);
    Route::get("edit-leave/{leave}",[LeaveController::class,'edit']);
    Route::post("update-leave",[LeaveController::class,'update']);
    Route::get("history",[UserController::class,'history']);

}); 

});