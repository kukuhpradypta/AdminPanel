<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginregisController;
use App\Http\Controllers\DashboardController;


use App\Mastermenu;

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

Route::get('/', 'DashboardController@index')->middleware('auth');

Route::post('/login', [LoginregisController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginregisController::class, 'logout'])->middleware('auth');
Route::get('/loginregis', [LoginregisController::class, 'index'])->name('login')->middleware('guest');
Route::post('/regis', [LoginregisController::class, 'store'])->middleware('guest');

Route::resource('usergroup', UsergroupController::class)->middleware('auth');
Route::get('usergroup/find/{id}', 'UsergroupController@find')->middleware('auth');

Route::resource('mastermenu', MastermenuController::class)->middleware('auth');
Route::get('mastermenu/find/{id}', 'MastermenuController@find')->middleware('auth');

Route::resource('user', UserController::class)->middleware('auth');
Route::get('user/find/{id}', 'userController@find')->middleware('auth');

Route::resource('userprivilage', UserprivilageController::class)->middleware('auth');
Route::get('userprivilage/find/{id}', 'userprivilageController@find')->middleware('auth');
