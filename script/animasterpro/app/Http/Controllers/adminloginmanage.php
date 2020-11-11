<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Admin;


class adminloginmanage extends Controller
{

    use AuthenticatesUsers;
// SHOW LOGIN PAGE
    public function loginindex()
    {
        if(!Auth::guard('admin')->check())
        {
            return view('cp.cp_login');
        }
        else
        {
            session::put('page','dashboard');
            return view('cp.index');
        }

    }
// LOGIN PROCCESS
    public function login(Request $request)
    {

        $validations = ["email"=>"required|email", "password"=>"required"];
        $validationMsgs =[
            "email.required"=>"Email is required",
            "email.email"=>"Email must be valid", 
            "password.required"=>"Password is required",  
        ];
            
        $this->validate($request, $validations, $validationMsgs);
        

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            session::put('page','dashboard');
            return redirect(route('dashboard.index'));
        }
        else
        {
            session()->flash('fail', 'Login data is incorrect');
            return back();
        }

        
    }
// LOGOUT
    public function logout()
    {
        Auth::guard('admin')->logout();
        
        return view('cp.cp_login');
    }
}
