<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Support\Facades\Log;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentParams;
use Codedge\Fpdf\Fpdf\Fpdf;
use DB;

class IcmController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    //
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }


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

    function  printerversionmale(Request $request){

        $studentDatas = DB::table('mtr_icm')
        ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
        ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
        ->where('student_params.gender','=','Male')
        ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
        ->get();
        return view("icm.printerversionmale",compact('studentDatas'));

    }

    function  printerversionfemale(Request $request){

        $studentDatas = DB::table('mtr_icm')
        ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
        ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
        ->where('student_params.gender','=','Female')
        ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
        ->get();
        return view("icm.printerversionfemale",compact('studentDatas'));
    }

    function  printerversionmalelist(Request $request){

        $studentDatas = StudentParams::where('status',0)->where('icm', $request->icm_id)->where('gender','Male')->get();
        return view("icm.printerversionmalelist",compact('studentDatas'));

    }

    function  printerversionfemalelist(Request $request){

        $studentDatas = StudentParams::where('status',0)->get();
        return view("icm.printerversionfemalelist",compact('studentDatas'));
    }

    function printerapplicationlistpdf(Request $request){

        $studentDatas = StudentParams::where('status',0)->where('icm', $request->icm_id)->where('gender',$request->gender)->get();

        $this->fpdf->AddPage('L');
        $this->fpdf->SetFont( 'Helvetica', 'B', 14 );
        $this->fpdf->Cell( 0, 10, 'APPLICATION FORM FOR DIPLOMA IN COOPERATIVE MANAGEMENT ', 0, 1, "C" );
        $this->fpdf->Cell( 0, 10, 'Tamil Nadu Cooperative Union', 0, 1, "C" );

        $this->fpdf->Cell( 0, 10, $studentDatas[0]->mtr_icm->icm_name, 0, 1, "C" );
        $this->fpdf->SetFont( 'Helvetica', 'B', 8 );
        
        $this->fpdf->Cell(8,7,'Sl No',1,0,'C');
        $this->fpdf->Cell(30,7,'ARN Number',1,0,'C');
        $this->fpdf->Cell(38,7,'Full name',1,0,'C');
        $this->fpdf->Cell(18,7,'Mobile No',1,0,'C');
        $this->fpdf->Cell(8,7,'Age',1,0,'C');
        $this->fpdf->Cell(20,7,'Aadhaar No',1,0,'C');
        $this->fpdf->Cell(30,7,'10th & 12th/Diploma',1,0,'C');
        $this->fpdf->Cell(25,7,'TC',1,0,'C');
        $this->fpdf->Cell(25,7,'Community',1,0,'C');
        $this->fpdf->Cell(38,7,'UPI No. / Challon No',1,0,'C');
        $this->fpdf->Cell(38,7,'Selected/Not Selected',1,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->SetFont( 'Helvetica', 'B', 7 );
        $this->fpdf->Cell(8,7,'',1,0,'C');
        $this->fpdf->Cell(30,7,'',1,0,'C');
        $this->fpdf->Cell(38,7,'',1,0,'C');
        $this->fpdf->Cell(18,7,'',1,0,'C');
        $this->fpdf->Cell(8,7,'',1,0,'C');
        $this->fpdf->Cell(20,7,'',1,0,'C');
        $this->fpdf->Cell(30,7,'Yes / No',1,0,'C');
       // $this->fpdf->Cell(25,7,'Verified / Not verified',1,0,'C');
        $this->fpdf->Cell(25,7,'Yes / No',1,0,'C');
        $this->fpdf->Cell(25,7,'Yes / No',1,0,'C');
        $this->fpdf->Cell(38,7,'',1,0,'C');
        $this->fpdf->Cell(38,7,'',1,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->SetFont( 'Helvetica', 'B', 8 );
        $count = 1;
        foreach($studentDatas as $studentData){

            // $markssecuredone = "";
            // $markssecuredtwo = "";
            // if(!empty($studentData->aslsecumark)){
            //   $markssecuredone =  $studentData->aslsecumark;
            // }
            // if(!empty($studentData->ahssecumark)){
            //   $markssecuredtwo =  $studentData->ahssecumark;
            // }

           // $address = $studentData->plotno.",".$studentData->streetname.",".$studentData->city.",".$studentData->district.",".$studentData->state.",".$studentData->pincode;

            $this->fpdf->Cell(8,7,$count++,1);
            $this->fpdf->Cell(30,7,$studentData->arrn_number,1,0,'C');
            $this->fpdf->Cell(38,7,$studentData->fullname,1);
            $this->fpdf->Cell(18,7,$studentData->mobile1,1);
            $this->fpdf->Cell(8,7,$studentData->age,1,0,'C');
            $this->fpdf->Cell(20,7,$studentData->aadhar,1,0,'C');
            $this->fpdf->Cell(30,7,'',1);
           // $this->fpdf->Cell(25,7,$markssecuredone,1);
           // $this->fpdf->Cell(25,7,$markssecuredtwo,1);
            $this->fpdf->Cell(25,7,'',1);
            $this->fpdf->Cell(25,7,'',1);
            $this->fpdf->Cell(38,7,$studentData->transno." / ".$studentData->challonno ,1);
            $this->fpdf->Cell(38,7,'',1,0);
            $this->fpdf->Ln();
        }

        $this->fpdf->Ln();
        $this->fpdf->SetFont( 'Helvetica', 'B', 10 );
        $this->fpdf->Cell(38,7,'Institute Manager :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'Principal :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'Committee Members :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'1. :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'2. :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'3. :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'4. :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'5. :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'6. :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'7. :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'8. :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'9. :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'10. :',0,0);

        // Define the file path where you want to save the PDF
        $filePath = 'uploads/applications/'.$studentDatas[0]->mtr_icm->icm_name.".pdf"; // Replace with your desired file path and name

        // Output the PDF to the specified file path
        $this->fpdf->Output($filePath, 'F');
        //Set the appropriate headers for file download
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        // Provide the file as a download response
        return response()->download($filePath, $studentDatas[0]->mtr_icm->icm_name.".pdf", $headers);
        exit;
    }


}
