<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usergroup;
use App\Mastermenu;
use App\Userprivilage;

class UsergroupController extends Controller
{
    public function index(Request $request)
    {
        $mastermenus = Mastermenu::all();

        $usergroups = Usergroup::paginate(10);
        return view('usergroup.index', compact('usergroups', 'mastermenus',));
    }

    public function create()
    {
        $userprivilages = Userprivilage::all();
        $mastermenus = Mastermenu::all();
        return view('usergroup.create', compact('mastermenus', 'userprivilages'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'name'     => 'required',
            'sort'     => 'required',

        ]);

        $usergroup = Usergroup::create([
            'name'     => $request->name,
            'sort'     => $request->sort,

        ]);

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
            'sort'     => 'required',
        ]);

        //get data usergroup by ID
        $usergroup = Usergroup::findOrFail($usergroup->id);

        $usergroup->update([
            'name'     => $request->name,
            'sort'     => $request->sort,
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
