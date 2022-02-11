<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usergroup;
use App\Usergroupprivilage;
use App\Mastermenu;


class UsergroupprivilageController extends Controller
{
    public function index(Request $request)
    {
        $mastermenus = Mastermenu::all();
        $usergroups = Usergroup::all();
        $usergroupprivilages = Usergroupprivilage::paginate(10);
        return view('usergroupprivilage.index', compact('usergroupprivilages', 'mastermenus', 'usergroups'));
    }

    public function store(Request $request)
    {
        $usergroupprivilage['id_usergroup'] = $request->id_usergroup;
        $usergroupprivilage['id_menu'] = $request->id_menu;
        $usergroupprivilage['has_view'] = $request->has_view;
        $usergroupprivilage['has_create'] = $request->has_create;
        $usergroupprivilage['has_update'] = $request->has_update;
        $usergroupprivilage['has_delete'] = $request->has_delete;

        Usergroupprivilage::insert($usergroupprivilage);
        // $this->validate($request, [

        //     'name'     => 'required',
        //     'sort'     => 'required',

        // ]);

        // $usergroup = Usergroup::create([
        //     'name'     => $request->name,
        //     'sort'     => $request->sort,

        // ]);

        if ($usergroupprivilage) {
            //redirect dengan pesan sukses
            return redirect()->route('usergroupprivilage.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('usergroupprivilage.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function update(Request $request, Usergroupprivilage $usergroupprivilage)
    {
        $this->validate($request, [
            'id_usergroup'     => 'required',
            'id_menu'     => 'required',
            'has_view'     => 'required',
            'has_create'     => 'required',
            'has_update'     => 'required',
            'has_delete'     => 'required',
        ]);

        //get data usergroup by ID
        $usergroupprivilage = Usergroupprivilage::findOrFail($usergroupprivilage->id);

        $usergroupprivilage->update([
            'id_usergroup'     => $request->id_usergroup,
            'id_menu'     => $request->id_usergroup,
            'has_view'     => $request->id_usergroup,
            'has_create'     => $request->id_usergroup,
            'has_update'     => $request->id_usergroup,
            'has_delete'     => $request->id_usergroup,
        ]);

        if ($usergroupprivilage) {
            //redirect dengan pesan sukses
            return redirect()->route('usergroupprivilage.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('usergroupprivilage.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {

        $usergroupprivilage = Usergroupprivilage::findOrFail($id);
        $usergroupprivilage->delete();

        if ($usergroupprivilage) {
            //redirect dengan pesan sukses
            return redirect()->route('usergroupprivilage.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('usergroupprivilage.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function find(Request $request)
    {
        if ($request->id) {
            $data = Usergroupprivilage::find($request->id);
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
