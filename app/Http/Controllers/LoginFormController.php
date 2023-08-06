<?php

namespace App\Http\Controllers;
use Hash;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginFormController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //
    function index(){
        return view("icm.login");
    }
    
    function checklogin(Request $request){

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/icm/dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect('login')->with('error', 'Login details are not valid');

    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('login');
    }
}
