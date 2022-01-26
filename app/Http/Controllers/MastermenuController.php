<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mastermenu;


class MastermenuController extends Controller
{
    public function index()
    {
        $mastermenus = Mastermenu::paginate(10);
        return view('mastermenu.index', compact('mastermenus'));
    }

    public function store(Request $request)
    {
        $mastermenu['name'] = $request->name;
        $mastermenu['icon'] = $request->icon;
        $mastermenu['url'] = $request->url;
        $mastermenu['sort'] = $request->sort;
        $mastermenu['menugroup'] = $request->menugroup;
        $mastermenu['ishidden'] = $request->ishidden;
        Mastermenu::insert($mastermenu);
        // $this->validate($request, [

        //     'name'     => 'required',
        //     'icon'     => 'required',
        //     'url'     => 'required',
        //     'sort'     => 'required',
        //     'menugroup'     => 'required',
        //     'ishidden'     => 'required',

        // ]);

        // $mastermenu = Mastermenu::create([
        //     'name'     => $request->name,
        //     'icon'     => $request->icon,
        //     'url'     => $request->url,
        //     'sort'     => $request->sort,
        //     'menugroup'     => $request->menugroup,
        //     'ishidden'     => $request->ishidden,

        // ]);

        if ($mastermenu) {
            //redirect dengan pesan sukses
            return redirect()->route('mastermenu.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('mastermenu.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function update(Request $request, mastermenu $mastermenu)
    {
        $this->validate($request, [
            'name'     => 'required',
            'icon'     => 'required',
            'url'     => 'required',
            'sort'     => 'required',
            'menugroup'     => 'required',
            'ishidden'     => 'required',
        ]);


        $mastermenu = Mastermenu::findOrFail($mastermenu->id);

        $mastermenu->update([
            'name'     => $request->name,
            'icon'     => $request->icon,
            'url'     => $request->url,
            'sort'     => $request->sort,
            'menugroup'     => $request->menugroup,
            'ishidden'     => $request->ishidden,
        ]);

        if ($mastermenu) {
            //redirect dengan pesan sukses
            return redirect()->route('mastermenu.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('mastermenu.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {

        $mastermenu = Mastermenu::findOrFail($id);
        $mastermenu->delete();

        if ($mastermenu) {
            //redirect dengan pesan sukses
            return redirect()->route('mastermenu.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('mastermenu.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function find(Request $request)
    {
        if ($request->id) {
            $data = Mastermenu::find($request->id);
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
