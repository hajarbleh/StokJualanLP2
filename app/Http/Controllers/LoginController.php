<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $attempt = Auth::attempt($request->only('nrp', 'password'));
        if ($attempt) {
            return redirect('/');
        } else {
            return redirect()->back()->with('login', 'fail');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
