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

        if(Auth::user()->role == 1){
            $studentDatas = StudentParams::paginate(8);
        }else{
            $studentDatas = StudentParams::where('icm', Auth::user()->icm_id)->where('status',0)->paginate(8);
        }
      
        return view("icm.applicationlist", compact('studentDatas'));
    }
    function selectedapplicationlist(){

        if(Auth::user()->role == 1){
            $studentDatas = StudentParams::paginate(8);
        }else{
            $studentDatas = StudentParams::where('icm', Auth::user()->icm_id)->where('status',1)->paginate(8);
        }
      
        return view("icm.selectedapplicationlist", compact('studentDatas'));
    }
}
