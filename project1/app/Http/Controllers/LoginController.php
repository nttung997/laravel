<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6|max:32',
        ], [
            'password.min' => 'Password must be longer than 5 character',
            'password.max' => 'Password must be shorter than 33 character',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // dd(Auth::user());
            return redirect('admin/roles');
        } else {
            return back()->withErrors(['failed' => 'Login Failed']);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('');
    }
}
