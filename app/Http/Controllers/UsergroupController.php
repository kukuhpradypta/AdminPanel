<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usergroup;
use App\Mastermenu;
use App\Usergroupprivilage;

class UsergroupController extends Controller
{
    public function index(Request $request)
    {
        $mastermenus = Mastermenu::all();
        $usergroupprivilages = Usergroupprivilage::all();
        $usergroups = Usergroup::paginate(10);
        return view('usergroup.index', compact('usergroups', 'mastermenus', 'usergroupprivilages'));
    }

    public function store(Request $request)
    {
        $usergroup['name'] = $request->name;
        Usergroup::insert($usergroup);
        $usergroupprivilage['id_usergroup'] = $request->id_usergroup;
        $usergroupprivilage['id_menu'] = $request->id_menu;
        $usergroupprivilage['has_view'] = $request->has_view;
        $usergroupprivilage['has_create'] = $request->has_create;
        $usergroupprivilage['has_update'] = $request->has_update;
        $usergroupprivilage['has_delete'] = $request->has_delete;
        Usergroupprivilage::insert($usergroupprivilage);
        // $this->validate($request, [

        //     'name'     => 'required',

        // ]);

        // $usergroup = Usergroup::create([
        //     'name'     => $request->name,

        // ]);

        if ($usergroup) {
            //redirect dengan pesan sukses
            return redirect()->route('usergroup.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('usergroup.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function update(Request $request, Usergroup $usergroup)
    {
        $this->validate($request, [
            'name'     => 'required',
        ]);

        //get data usergroup by ID
        $usergroup = Usergroup::findOrFail($usergroup->id);

        $usergroup->update([
            'name'     => $request->name,

        ]);

        if ($usergroup) {
            //redirect dengan pesan sukses
            return redirect()->route('usergroup.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('usergroup.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {

        $usergroup = Usergroup::findOrFail($id);
        $usergroup->delete();

        if ($usergroup) {
            //redirect dengan pesan sukses
            return redirect()->route('usergroup.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('usergroup.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function find(Request $request)
    {
        if ($request->id) {
            $data = Usergroup::find($request->id);
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
