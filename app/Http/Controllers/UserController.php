<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mastermenu;
use App\User;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function index(Request $request)
    {
        $mastermenus = Mastermenu::all();

        $users = User::paginate(10);
        return view('user.index', compact('users', 'mastermenus',));
    }

    public function create()
    {

        $mastermenus = Mastermenu::all();
        return view('user.create', compact('mastermenus'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:3|max:255',
        ]);

        //   $validatedData['password'] = bcrypt($validatedData['password']);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        //   $request->session()->flash('success', 'Registration successfull! Please login');
        if ($validatedData) {
            //redirect dengan pesan sukses
            return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('user.index')->with(['error' => 'Data Gagal Diupdate!']);
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

        $user = User::findOrFail($id);
        $user->delete();

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
