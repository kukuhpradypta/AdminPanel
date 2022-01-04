<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginregisController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can Loginregis web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/login', [LoginregisController::class,'authenticate'])->middleware('guest');
Route::post('/logout', [LoginregisController::class,'logout'])->middleware('auth');
Route::get('/loginregis', [LoginregisController::class,'index'])->name('login')->middleware('guest');
Route::post('/regis', [LoginregisController::class,'store'])->middleware('guest');
Route::get('/', [DashboardController::class,'index'])->middleware('auth');

// Route::get('/', function () {
//     return view('home')->middleware('auth');
// });
