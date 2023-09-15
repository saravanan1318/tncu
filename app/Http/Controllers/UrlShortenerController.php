<?php

namespace App\Http\Controllers;

use App\Models\StudentParams;
use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    public function redirect($code)
    {
        $query = "SELECT * FROM student_params WHERE SUBSTRING(MD5(arrn_number), 1, 5) = SUBSTRING('$code', 1, 5)";
        $url = DB::select($query);
        if(count($url) >0)
        foreach ($url as $value)
        {

            return redirect(env('SELF_URI')."/uploads/applications/".$value->arrn_number.".pdf");
        }
        else{
            return view("home");
        }

    }

}
