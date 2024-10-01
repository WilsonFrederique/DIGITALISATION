<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginPublic()
    {
        return view('auth.loginUser');
    }

    public function formUser()
    {
        return view('auth.formUser');
    }

    public function loginAdmin()
    {
        return view('auth.loginAdmin');
    }
}
