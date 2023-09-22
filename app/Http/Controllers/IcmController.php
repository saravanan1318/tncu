<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Support\Facades\Log;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentParams;
use DB;

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

        if(Auth::user()->role == 1){

            $allapplication = StudentParams::count();
            $pendingapplication = StudentParams::where('status', 0)->count();
            $selectedapplication = StudentParams::where('status', 1)->count();

        }else{

            $allapplication = StudentParams::where('icm', Auth::user()->icm_id)->count();
            $pendingapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status', 0)->count();
            $selectedapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status', 1)->count();
        }

        $studentDatas = DB::table('mtr_icm')
        ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
        ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
        ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
        ->get();

        $data[] = [
           "allapplication" =>  $allapplication,
           "pendingapplication" =>  $pendingapplication,
           "selectedapplication" =>  $selectedapplication
        ];

        return view("icm.dashboard",compact('data','studentDatas'));

    }

    function icmdashboard(){

        if(Auth::user()->role == 1){

            $allapplication = StudentParams::count();
            $pendingapplication = StudentParams::where('status', 0)->count();
            $selectedapplication = StudentParams::where('status', 1)->count();

        }else{

            $allapplication = StudentParams::where('icm', Auth::user()->icm_id)->count();
            $pendingapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status', 0)->count();
            $selectedapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status', 1)->count();
        }

        $studentDatas = DB::table('mtr_icm')
        ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
        ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
        ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
        ->get();

        $data[] = [
           "allapplication" =>  $allapplication,
           "pendingapplication" =>  $pendingapplication,
           "selectedapplication" =>  $selectedapplication
        ];

        return view("icm.icmdashboard",compact('data','studentDatas'));

    }

    function applicationlist(){

        if(Auth::user()->role == 1){
            $studentDatas = StudentParams::where('status',0)->get();
            $query="WITH DuplicateAadhar AS (
    SELECT aadhar
    FROM student_params
    GROUP BY aadhar
    HAVING COUNT(aadhar) = 1
),
DuplicateEmail AS (
    SELECT email
    FROM student_params
    GROUP BY email
    HAVING COUNT(email) = 1
),
DuplicateTransno AS (
    SELECT transno
    FROM student_params
    GROUP BY transno
    HAVING COUNT(transno) = 1
)
SELECT sp.*, mtr_icm.icm_name
FROM student_params sp
LEFT JOIN mtr_icm ON sp.icm = mtr_icm.id
WHERE  sp.status = 0
AND (sp.aadhar IN (SELECT aadhar FROM DuplicateAadhar)
   and sp.email IN (SELECT email FROM DuplicateEmail)
   and sp.transno IN (SELECT transno FROM DuplicateTransno)
   OR sp.duplicateaccept =1)
ORDER BY sp.id ASC;
";
            $studentDatas = DB::select($query);
//            $studentDatas = DB::select("select * from allapplication")->get();
        }else{
            $studentDatas = StudentParams::where('icm', Auth::user()->icm_id)->where('status',0)->get();
        }

        return view("icm.applicationlist", compact('studentDatas'));
    }
    function printapplicationlist(){

        if(Auth::user()->role == 1){
            $studentDatas = StudentParams::where('status',0)->get();
            $query="WITH DuplicateAadhar AS (
    SELECT aadhar
    FROM student_params
    GROUP BY aadhar
    HAVING COUNT(aadhar) = 1
),
DuplicateEmail AS (
    SELECT email
    FROM student_params
    GROUP BY email
    HAVING COUNT(email) = 1
),
DuplicateTransno AS (
    SELECT transno
    FROM student_params
    GROUP BY transno
    HAVING COUNT(transno) = 1
)
SELECT sp.*, mtr_icm.icm_name
FROM student_params sp
LEFT JOIN mtr_icm ON sp.icm = mtr_icm.id
WHERE  sp.status = 0
AND (sp.aadhar IN (SELECT aadhar FROM DuplicateAadhar)
   and sp.email IN (SELECT email FROM DuplicateEmail)
   and sp.transno IN (SELECT transno FROM DuplicateTransno)
   OR sp.duplicateaccept =1)
ORDER BY sp.id ASC;
";
            $studentDatas = DB::select($query);
//            $studentDatas = DB::select("select * from allapplication")->get();
        }else{
            $studentDatas = StudentParams::where('icm', Auth::user()->icm_id)->where('status',0)->get();
        }

        return view("icm.printapplicationlist", compact('studentDatas'));
    }
    function selectedapplicationlist(){

        if(Auth::user()->role == 1){
            $studentDatas = StudentParams::where('status',1)->get();
        }else{
            $studentDatas = StudentParams::where('icm', Auth::user()->icm_id)->where('status',1)->get();
        }

        return view("icm.selectedapplicationlist", compact('studentDatas'));
    }

    function duplicateapplicationlist(){

        /*$studentDatas = DB::select("SELECT student_params.*,mtr_icm.icm_name FROM student_params
        LEFT JOIN mtr_icm ON student_params.icm = mtr_icm.id
        WHERE aadhar IN (SELECT aadhar AS noofapps
        FROM student_params
        GROUP BY aadhar
        HAVING COUNT(aadhar) > 1)
        UNION ALL
        SELECT student_params.*,mtr_icm.icm_name FROM student_params
        LEFT JOIN mtr_icm  ON student_params.icm = mtr_icm.id
        WHERE email IN (SELECT email AS noofapps
        FROM student_params
        GROUP BY email
        HAVING COUNT(email) > 1) ORDER BY id ASC");*/
        $query = "
   WITH DuplicateAadhar AS (
    SELECT aadhar
    FROM student_params
    GROUP BY aadhar
    HAVING COUNT(aadhar) > 1
),
DuplicateEmail AS (
    SELECT email
    FROM student_params
    GROUP BY email
    HAVING COUNT(email) > 1
),
DuplicateTransno AS (
    SELECT transno
    FROM student_params
    GROUP BY transno
    HAVING COUNT(transno) > 1
)
SELECT sp.*, mtr_icm.icm_name
FROM student_params sp
LEFT JOIN mtr_icm ON sp.icm = mtr_icm.id
WHERE (sp.aadhar IN (SELECT aadhar FROM DuplicateAadhar)
   or sp.email IN (SELECT email FROM DuplicateEmail)
   or sp.transno IN (SELECT transno FROM DuplicateTransno)
   OR sp.aadhar IS null
   OR sp.email IS null
   OR sp.transno IS NULL)
    AND (sp.duplicateaccept IS NULL ||  sp.duplicateaccept<>1)
ORDER BY sp.aadhar,sp.transno ASC;

";

        $studentDatas = DB::select($query);

        //$studentDatas = StudentParams::where('status',1)->get();

        return view("icm.duplicateapplicationlist", compact('studentDatas'));
    }

    function icmwiselist(){


        $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        return view("icm.icmwiselist", compact('studentDatas'));
    }

    function icmapplicationlist(Request $request){

        $studentDatas = StudentParams::where('icm', $request->icm_id)->get();

        return view("icm.icmapplicationlist", compact('studentDatas'));

    }
    function duplicateaccept(Request $request){

        $studentId = $request->input('id');
        $newOption = $request->input('option');
        $studentDatas= StudentParams::find($studentId);
        if(!$studentDatas)
        {
            return response()->json(['message' => 'Student not found'], 404);
        }
        $studentDatas->duplicateaccept = $newOption;
        $studentDatas->save();
        return response()->json(['message' => 'Option updated successfully']);
    }
    function  selectedlist(Request $request){
        $selectedCheckboxes = $request->input('selectedCheckboxes');

        // Update the status for the selected IDs to 1
        StudentParams::whereIn('id', $selectedCheckboxes)
            ->update(['status' => 1]);

        // Optionally, you can return a response
        return response()->json(['message' => 'Status updated successfully']);
    }
}
