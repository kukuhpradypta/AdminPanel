<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userprivilage;
use App\Mastermenu;

class UserprivilageController extends Controller
{
    public function index(Request $request)
    {
        $mastermenus = Mastermenu::all();

        $userprivilages = Userprivilage::paginate(10);
        return view('userprivilage.index', compact('userprivilages', 'mastermenus',));
    }

    public function create()
    {
        $userprivilages = Userprivilage::all();
        $mastermenus = Mastermenu::all();
        return view('userprivilage.create', compact('mastermenus', 'userprivilages'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'id_user'     => 'required',
            'id_menu'     => 'required',
            'namemenu'     => 'required',
            'has_create'     => 'required',
            'has_update'     => 'required',
            'has_delete'     => 'required',

        ]);

        $userprivilage = Userprivilage::create([
            'id_user'     => $request->id_user,
            'id_menu'     => $request->id_menu,
            'namemenu'     => $request->namemenu,
            'has_create'     => $request->has_create,
            'has_update'     => $request->has_update,
            'has_delete'     => $request->has_delete,
            
        ]);

        if ($userprivilage) {
            //redirect dengan pesan sukses
            return redirect()->route('userprivilage.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('userprivilage.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function update(Request $request, Userprivilage $userprivilage)
    {
        $this->validate($request, [
            'id_user'     => 'required',
            'id_menu'     => 'required',
            'namemenu'     => 'required',
            'has_create'     => 'required',
            'has_update'     => 'required',
            'has_delete'     => 'required',
        ]);

        //get data usergroup by ID
        $userprivilage = Userprivilage::findOrFail($userprivilage->id);

        $userprivilage->update([
            'id_user'     => $request->id_user,
            'id_menu'     => $request->id_menu,
            'namemenu'     => $request->namemenu,
            'has_create'     => $request->has_create,
            'has_update'     => $request->has_update,
            'has_delete'     => $request->has_delete,
        ]);

        if ($userprivilage) {
            //redirect dengan pesan sukses
            return redirect()->route('userprivilage.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('userprivilage.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {

        $userprivilage = Userprivilage::findOrFail($id);
        $userprivilage->delete();

        if ($userprivilage) {
            //redirect dengan pesan sukses
            return redirect()->route('userprivilage.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('userprivilage.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function find(Request $request)
    {
        if ($request->id) {
            $data = Userprivilage::find($request->id);
            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'msg' => 'berhasil mendapatkan data',
                    'data' => $data
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'not found',
                    'code' => 404
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'bad request',
                'code' => 402
            ]);
        }
    }
}

