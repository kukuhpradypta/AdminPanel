<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mastermenu;
use App\User;
use App\Usergroup;
use App\Userprivilage;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
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
        $userprivilages = Userprivilage::all();
        $users = User::paginate(10);
        return view('user.index', compact('users', 'mastermenus', 'userprivilages'));
    }

    public function create()
    {
        $role = Usergroup::all();
        $mastermenus = Mastermenu::all();
        return view('user.create', compact('mastermenus', 'role'));
    }

    public function store(Request $request)
    {
        $user = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:3|max:255',
        ]);
        $userg = new User;
        $userg->name = $request->name;
        $userg->email = $request->email;
        $userg->password = $request->password;
        $userg['password'] = Hash::make($userg['password']);
        $userg->save();
        $privs = json_decode($request->privileges, true);

        foreach ($privs as $userprivilage) {
            Userprivilage::create([
                'id_user' => $userg->id,
                'id_menu' => $userprivilage['id_menu'],
                'has_view' => $userprivilage['has_view'],
                'has_create' => $userprivilage['has_create'],
                'has_update' => $userprivilage['has_update'],
                'has_delete' => $userprivilage['has_delete'],

            ])->save();
        };


        // $request->session()->flash('success', 'Registration successfull! Please login');
        if ($user) {
            //redirect dengan pesan sukses
            return redirect()->route('user.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('user.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',

        ]);

        //get data user by ID
        $user = user::findOrFail($user->id);

        if ($request->password == $user->password) {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        } else if ($request->email == $user->email) {

            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);
        } else if ($request->name == $user->name) {

            $user->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }
        if ($user) {
            //redirect dengan pesan sukses
            return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('user.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {

        $user = User::findOrfail($id);
        $gprivillage = Userprivilage::all()->where('id_user', $id);
        $user->delete();
        foreach ($gprivillage as $value) {
            $usergp = Userprivilage::findOrfail($value->id);
            $usergp->delete();
        }

        if ($user) {
            //redirect dengan pesan sukses
            return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('user.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function find(Request $request)
    {
        if ($request->id) {
            $data = User::find($request->id);
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
