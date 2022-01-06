<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginregisController extends Controller
{
    public function index(){
        return view('loginregis.index');
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
      return redirect('/loginregis')->with('success', 'Registration successfull! Please login');
    }
    
    public function authenticate(Request $request)
    {
       $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError','Login Failed!');
        return back()->with('registerError','Register Failed!');
    }
    public function logout(){
      Auth::logout();
      request()->session()->invalidate();
      request()->session()->regenerateToken();
      return redirect('/loginregis');
    }
}
