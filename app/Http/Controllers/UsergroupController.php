<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usergroup;

class UsergroupController extends Controller
{
public function index()
    {
         $usergroups = Usergroup::latest()->paginate(10);
        return view('usergroup.index', compact('usergroups'));
    }

    public function create()
{
    return view('usergroup.create');
}

// public function store(Request $request)
// {
//     $this->validate($request, [
//         'name'     => 'required',
//     ]);

//     $usergroup = Usergroup::create([
//         'name'     => $request->name,
//     ]);

//         if($usergroup){
//             //redirect dengan pesan sukses
//             return redirect()->route('usergroup.index')->with(['success' => 'Data Berhasil Disimpan!']);
//         }else{
//             //redirect dengan pesan error
//             return redirect()->route('usergroup.index')->with(['error' => 'Data Gagal Disimpan!']);
//         }
// }
 public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Usergroup::create($request->all());
        return redirect()->route('usergroup.index')->with('success','Data berhasil di input');
    }
public function edit(Usergroup $usergroup)
{
    return view('usergroup.edit', compact('usergroup'));
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
