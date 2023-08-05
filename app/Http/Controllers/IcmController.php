<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IcmController extends Controller
{
    //
    function index(){
        return view("icm.dashboard");
    }
}
