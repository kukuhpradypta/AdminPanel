<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mastermenu;

class MastermenuController extends Controller
{
    public function index(){
    $mastermenus = Mastermenu::all();
    return view('dashboard', compact('mastermenus'));
}
}
