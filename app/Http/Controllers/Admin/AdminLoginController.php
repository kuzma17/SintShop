<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'admin';

    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function username()
    {
        return 'login';
    }

//    public function login(Request $request){
//        dd($request);
//    }


}
