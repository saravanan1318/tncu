<?php

namespace App\Http\Controllers;
use Hash;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentParams;

class IcmController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //
    function index(){
        return view("icm.login");
    }
    function dashboard(){
        return view("icm.dashboard");
    }
    function applicationlist(){

        $studentDatas = StudentParams::where('icm', Auth::user()->icm_id)->paginate(8);
        return view("icm.applicationlist", compact('studentDatas'));
    }
}
