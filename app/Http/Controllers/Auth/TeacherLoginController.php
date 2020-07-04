<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;


class AdminLoginController extends Controller
{
  
    public function login(Request $request)
    {
        $validateData=$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(Auth::guard('teacher')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember))
        {
            return redirect()->intended('teacher-dashboard');
        }
        
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    
}
