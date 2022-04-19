<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginregisController extends Controller
{
  public function index(Request $request)
  {
    if ($request->session()->get('id')) {
      return redirect('/');
    }
    return view('loginregis.index');
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|min:3|max:255',
      'email' => 'required|email:dns|unique:users',
      'password' => 'required|min:3|max:255',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    User::create($validatedData);

    return redirect('/loginregis')->with('success', 'Registration successfull! Please login');
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email:dns',
      'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {

      $request->session()->put('id', Auth::id());
      $request->session()->regenerate();
      return redirect('/');
    }

    return back()->with('loginError', 'Login Failed!');
    return back()->with('registerError', 'Register Failed!');
  }
  public function logout()
  {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/loginregis');
  }
}
