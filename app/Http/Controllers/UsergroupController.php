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

        $mastermenus = Mastermenu::where('ishidden', 0)->select('name', 'id', 'icon')->orderBy('sort', 'ASC')->get();
        foreach ($mastermenus as $mn) {
            $mn->has_view = 0;
            $mn->has_create = 0;
            $mn->has_edit = 0;
            $mn->has_delete = 0;
        }
        $usergroupprivilages = Usergroupprivilage::all();
        $usergroups = Usergroup::paginate(10);
        return view('usergroup.index', compact('usergroups', 'mastermenus', 'usergroupprivilages'));
    }

    public function store(Request $request)
    {
        $usergroup['name'] = $request->name;
        $userg = new Usergroup;
        $userg->name = $request->name;
        $userg->save();
        $privs = json_decode($request->privileges, true);

        foreach ($privs as $usergroupprivilage) {
            Usergroupprivilage::create([
                'id_usergroup' => $userg->id,
                'id_menu' => $usergroupprivilage['id_menu'],
                'has_view' => $usergroupprivilage['has_view'],
                'has_create' => $usergroupprivilage['has_create'],
                'has_update' => $usergroupprivilage['has_update'],
                'has_delete' => $usergroupprivilage['has_delete'],

            ])->save();
        };


        if ($usergroup) {
            //redirect dengan pesan sukses
            return redirect()->route('usergroup.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('usergroup.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    // public function update(Request $request, Usergroup $usergroup)
    // {
    //     $this->validate($request, [
    //         'name'     => 'required',
    //     ]);

    //     //get data usergroup by ID
    //     $usergroup = Usergroup::findOrFail($usergroup->id);



    //     $usergroup->update([
    //         'name'     => $request->name,

    //     ]);

    //     if ($usergroup) {
    //         //redirect dengan pesan sukses
    //         return redirect()->route('usergroup.index')->with(['success' => 'Data Berhasil Diupdate!']);
    //     } else {
    //         //redirect dengan pesan error
    //         return redirect()->route('usergroup.index')->with(['error' => 'Data Gagal Diupdate!']);
    //     }
    // }
    public function update(Request $request, $id)
    {
        $usergroup = Usergroup::find($id);
        $usergroup = Usergroup::where('id', $id)->first();
        $usergroup->name = $request->input('name');
        $usergroup->save();

        $usergroupprivilage = Usergroupprivilage::find($id);
        $usergroupprivilage = Usergroupprivilage::where('id', $id)->first();
        $usergroupprivilage->id_usergroup = $request->input('id_usergroup');
        $usergroupprivilage->id_menu = $request->input('id_menu');
        $usergroupprivilage->has_create = $request->input('has_create');
        $usergroupprivilage->has_view = $request->input('has_view');
        $usergroupprivilage->has_update = $request->input('has_update');
        $usergroupprivilage->has_delete = $request->input('has_delete');
        $usergroupprivilage->save();

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
        $usergroup = Usergroup::findOrfail($id);
        $gprivillage = Usergroupprivilage::all()->where('id_usergroup', $id);
        $usergroup->delete();
        foreach ($gprivillage as $value) {
            $usergp = Usergroupprivilage::findOrfail($value->id);
            $usergp->delete();
        }


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
            $master = Mastermenu::all();
            if ($data) {
                return response()->json([
                    'status' => 'success',
                    'msg' => 'berhasil mendapatkan data',
                    'data' => $data,
                    'usergp' => $data->usergroupprivilage,
                    'master' => $master
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
    // public function find(Request $request)
    // {
    //     if ($request->id) {
    //         $data = Usergroup::find($request->id);
    //         $master = Mastermenu::all();

    //         if ($data) {
    //             foreach ($data as $value) {
    //                 return response()->json([
    //                     'status' => 'success',
    //                     'msg' => 'berhasil mendapatkan data',
    //                     'data' => $data,
    //                     'usergp' => $data->usergroupprivilage,
    //                     'master' => $master
    //                 ]);
    //             }
    //         } else {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'msg' => 'not found',
    //                 'code' => 404
    //             ]);
    //         }
    //     } else {
    //         return response()->json([
    //             'status' => 'error',
    //             'msg' => 'bad request',
    //             'code' => 402
    //         ]);
    //     }
    // }
}
