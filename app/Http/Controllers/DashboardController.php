<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mastermenu;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $mastermenus = Mastermenu::all();
        return view('dashboard',compact('mastermenus'));
    }
}
