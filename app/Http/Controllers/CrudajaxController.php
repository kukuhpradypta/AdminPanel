<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mastermenu;
use App\Crudajax;


class CrudajaxController extends Controller
{
    public function index()
    {
        $mastermenus = Mastermenu::all();
        $crudajaxs = Crudajax::latest()->paginate(10);
        return view('crudajax.index', compact('mastermenus', 'crudajaxs'));
    }

    public function create()
    {
        $mastermenus = Mastermenu::all();
        return view('crudajax.create', compact('mastermenus'));
    }
    public function store(Request $request)
    {
        $data['name'] = $request->name;
        Crudajax::insert($data);
    }
    public function destroy($id)
    {

        $crudajax = Crudajax::findOrFail($id);
        $crudajax->delete();

        if ($crudajax) {
            //redirect dengan pesan sukses
            return redirect()->route('crudajax.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('crudajax.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
