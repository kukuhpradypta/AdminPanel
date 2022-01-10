<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usergroup;
use App\Mastermenu;
class UsergroupController extends Controller
{
public function index()
    {
        $mastermenus = Mastermenu::all();
        $usergroups = Usergroup::latest()->paginate(10);
        return view('usergroup.index', compact('usergroups','mastermenus'));
    }

    public function create()
{
    $mastermenus = Mastermenu::all();
    return view('usergroup.create',compact('mastermenus'));
}

 public function store(Request $request)
    {
        $this->validate($request, [
       
        'name'     => 'required',

    ]);

    $usergroup = Usergroup::create([
        'name'     => $request->name,

    ]);

    if($usergroup){
        //redirect dengan pesan sukses
        return redirect()->route('usergroup.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('usergroup.index')->with(['error' => 'Data Gagal Disimpan!']);
    }
    }
public function edit(Usergroup $usergroup)
{
    $mastermenus = Mastermenu::all();
    return view('usergroup.edit', compact('usergroup','mastermenus'));
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

    if($usergroup){
        //redirect dengan pesan sukses
        return redirect()->route('usergroup.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('usergroup.index')->with(['error' => 'Data Gagal Diupdate!']);
    }
}

public function destroy($id)
    {
        
        $usergroup = Usergroup::findOrFail($id);
        $usergroup->delete();
       
        if($usergroup){
        //redirect dengan pesan sukses
        return redirect()->route('usergroup.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('usergroup.index')->with(['error' => 'Data Gagal Dihapus!']);
    }
    }

}
