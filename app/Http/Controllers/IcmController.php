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
use PDF;

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

    function passwordChange(){
        return view("icm.passwordChange");
    }

    function updatePassword(Request $request){
        
        if($request->password1 <> $request->password2){
            return redirect()->back()->withInput($request->input())->with('error', 'Password and Confirm password is not same');
        }

       // dd(Auth::user()->id);
        User::where('id', Auth::user()->id)
        ->update(['password' => Hash::make($request->password1), 'forcePasswordChange' => 0]);

        if(Auth::user()->role == 1){
            return redirect()->intended('/icm/dashboard')
            ->withSuccess('Signed in');
        }else if(Auth::user()->role == 2){
            return redirect()->intended('/icm/icmdashboard')
                    ->withSuccess('Signed in');
        } 

        return redirect('login')->with('error', 'Login details are not valid');

    }

    function dashboard(){

        if(Auth::user()->role == 1){

            $allapplication = StudentParams::where('status',"<>", 2)->count();
            $pendingapplication = StudentParams::where('status', 0)->count();
            $selectedapplication = StudentParams::where('status', 1)->count();
            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.status',0)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();
        }else{

            $allapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status',"<>", 2)->count();
            $pendingapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status', 0)->count();
            $selectedapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status', 1)->count();
            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.icm',Auth::user()->icm_id)
            ->where('student_params.status',0)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();
        }

        

        $data[] = [
           "allapplication" =>  $allapplication,
           "pendingapplication" =>  $pendingapplication,
           "selectedapplication" =>  $selectedapplication
        ];

        return view("icm.dashboard",compact('data','studentDatas'));

    }

    function icmdashboard(){

        if(Auth::user()->role == 1){

            $allapplication = StudentParams::where('status',"<>", 2)->count();
            $pendingapplication = StudentParams::where('status', 0)->count();
            $selectedapplication = StudentParams::where('status', 1)->count();

        }else{

            $allapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status',"<>", 2)->count();
            $pendingapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status', 0)->count();
            $selectedapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status', 1)->count();
        }

        $studentDatas = DB::table('mtr_icm')
        ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
        ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
        ->where('student_params.status',0)
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
        }else{
            $studentDatas = StudentParams::where('icm', Auth::user()->icm_id)->where('status',0)->get();
        }

        return view("icm.applicationlist", compact('studentDatas'));
    }
    function printapplicationlist(){

        if(Auth::user()->role == 1){
            $studentDatas = StudentParams::where('status',0)->get();
        }else{
            $studentDatas = StudentParams::where('icm', Auth::user()->icm_id)->where('status',0)->get();
        }

        return view("icm.printapplicationlist", compact('studentDatas'));
    }

    function selectedapplicationicmlistfemale(Request $request){

        if(Auth::user()->role == 1){

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=','Female')
            ->where('student_params.status',1)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }else{

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=','Female')
            ->where('student_params.status',1)
            ->where('student_params.icm','=',Auth::user()->icm_id)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }

        return view("icm.selectedapplicationlistfemale", compact('studentDatas'));
    }

    function selectedapplicationicmlistmale(Request $request){

        if(Auth::user()->role == 1){

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=','Male')
            ->where('student_params.status',1)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }else{

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=','Male')
            ->where('student_params.status',1)
            ->where('student_params.icm','=',Auth::user()->icm_id)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }

        return view("icm.selectedapplicationlistmale", compact('studentDatas'));
    }


    function selectedapplicationlistgendericm(Request $request){

        $studentDatas = StudentParams::where('icm', $request->icm_id)->where('gender', $request->gender)->where('status',1)->get();


        return view("icm.selectedapplicationlist", compact('studentDatas'));
    }


    function duplicateapplicationlist(){

        if(Auth::user()->role == 1){
            $studentDatas = StudentParams::where('status',2)->get();
        }else{
            $studentDatas = StudentParams::where('icm', Auth::user()->icm_id)->where('status',2)->get();
        }
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

        $studentDatas = StudentParams::where('icm', $request->icm_id)->where('status',0)->get();

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
        $studentDatas->status = $newOption;
        $studentDatas->save();
        return response()->json(['message' => 'Option updated successfully']);
    }
    function  selectedlist(Request $request){
        $selectedCheckboxes = $request->input('selectedCheckboxes');

        $message = "";
        $offset = 0;
        foreach($selectedCheckboxes as $selectedCheckboxe){       
            $studentDatas1 = StudentParams::where('id', $selectedCheckboxe)->where('status', 0)->first();
            if($studentDatas1)
            {
                $studentDatas = StudentParams::where('aadhar', $studentDatas1['aadhar'])->where('status', 1)->first();
                if($studentDatas){
                    unset($selectedCheckboxes[$offset]);
                    $message .= $studentDatas->aadhar.", ";
                }
            }
        }

        if(!empty($message)){
            $message = $message." Adhaar already selected";
        }else{
            $message = "Status updated successfully";
        }

        // Update the status for the selected IDs to 1
        StudentParams::whereIn('id', $selectedCheckboxes)
            ->update(['status' => 1]);

        // Optionally, you can return a response
        return response()->json(['message' => $message]);
    }

    function  printerversionmale(Request $request){


        if(Auth::user()->role == 1){

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=','Male')
            ->where('student_params.status',0)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }else{

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=','Male')
            ->where('student_params.status',0)
            ->where('student_params.icm','=',Auth::user()->icm_id)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }
       
        return view("icm.printerversionmale",compact('studentDatas'));

    }

    function  printerversionfemale(Request $request){

        if(Auth::user()->role == 1){

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=','Female')
            ->where('student_params.status',0)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }else{

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=','Female')
            ->where('student_params.status',0)
            ->where('student_params.icm','=',Auth::user()->icm_id)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }

        return view("icm.printerversionfemale",compact('studentDatas'));
    }

    function  printerversionmalelist(Request $request){


        $studentDatas = StudentParams::where('status',0)->where('icm', $request->icm_id)->where('gender',$request->gender)->get();

       
        return view("icm.printerversionmalelist",compact('studentDatas'));

    }

    function  printerversionfemalelist(Request $request){

        $studentDatas = StudentParams::where('status',0)->where('icm', $request->icm_id)->where('gender',$request->gender)->get();


        return view("icm.printerversionfemalelist",compact('studentDatas'));
    }

    function  contacticmlist(Request $request){


        $gender = $request->gender;

        if(Auth::user()->role == 1){

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=',$gender)
            ->where('student_params.status',0)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }else{

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=',$gender)
            ->where('student_params.status',0)
            ->where('student_params.icm','=',Auth::user()->icm_id)
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }

        return view("icm.contacticmlist",compact('studentDatas','gender'));

    }

    function  contacticmapplicationlist(Request $request){

        $studentDatas = StudentParams::where('icm', $request->icm_id)->where('gender',$request->gender)->where('status',0)->get();


        $html = '<!DOCTYPE html> <html> <head> <style> table { font-family: arial, sans-serif; border-collapse: collapse; width: 100%; font-size: 8px; } td { border: 1px solid #dddddd; text-align: left; padding: 20px; } tr:nth-child(even) { background-color: #dddddd; } h3,h4,.slno{ text-align: center; } th{ background-color: black; color: #fff; text-align: center; border: 1px solid #dddddd; padding: 20px; font-size: 10px !important;} </style> </head> <body> <h3>CONTACT DETAILS OF DIPLOMA IN COOPERATIVE MANAGEMENT 2023-24</h3> <h4>Tamil Nadu Cooperative Union</h4> <h4>'.$studentDatas[0]->mtr_icm->icm_name.'</h4> <table> <tr> <th style="width:5%" class="slno">SlNo</th> <th style="width:15%">ARN Number</th> <th style="width:20%">Full name</th> <th style="width:10%">MobileNo</th><th style="width:50%">Address</th> </tr> <tbody>';
        
        $count = 1;
        foreach($studentDatas as $studentData){
            $address = $studentData->plotno.", ".$studentData->streetname.", ".$studentData->city.", ".$studentData->district.", ".$studentData->state.", ".$studentData->pincode;

            $html .= '<tr>
            <td style="width:5%" class="slno">'.$count++.'</td>
            <td style="width:15%" class="slno">'.$studentData->arrn_number.'</td>
            <td style="width:20%" class="slno">'.$studentData->fullname.'</td>
            <td style="width:10%" class="slno">'.$studentData->mobile1.'</td>
            <td style="width:50%" class="slno">'.$address.'</td>
          </tr>';
        }

        $html .= '</tbody></table></body></html>';
        
        $filenametodownload = $studentDatas[0]->mtr_icm->icm_name."_contact.pdf";
        PDF::SetTitle('Hello World');
        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output($filenametodownload);
        
    }

    function printerapplicationlistpdf(Request $request){

        $studentDatas = StudentParams::where('status',0)->where('icm', $request->icm_id)->where('gender',$request->gender)->get();

        $this->fpdf->AddPage('L');
        $this->fpdf->SetFont( 'Helvetica', 'B', 10 );
        $this->fpdf->Cell( 0, 10, 'DIPLOMA IN COOPERATIVE MANAGEMENT ', 0, 1, "C" );
        $this->fpdf->Cell( 0, 10, 'Tamil Nadu Cooperative Union', 0, 1, "C" );

        $this->fpdf->Cell( 0, 10, $studentDatas[0]->mtr_icm->icm_name, 0, 1, "C" );
        $this->fpdf->SetFont( 'Helvetica', 'B', 8 );
        
        $this->fpdf->Cell(8,7,'Sl No',1,0,'C');
        $this->fpdf->Cell(30,7,'ARN Number',1,0,'C');
        $this->fpdf->Cell(38,7,'Full name',1,0,'C');
        $this->fpdf->Cell(18,7,'Mobile No',1,0,'C');
        $this->fpdf->Cell(8,7,'Age',1,0,'C');
        $this->fpdf->Cell(20,7,'Aadhaar No',1,0,'C');
        $this->fpdf->Cell(15,7,'10th',1,0,'C');
        $this->fpdf->Cell(15,7,'12th/Dip',1,0,'C');
        $this->fpdf->Cell(15,7,'Degree',1,0,'C');
        $this->fpdf->Cell(15,7,'PG',1,0,'C');
        $this->fpdf->Cell(15,7,'TC',1,0,'C');
        $this->fpdf->Cell(20,7,'Community',1,0,'C');
        $this->fpdf->Cell(38,7,'UPI No. / Challon No',1,0,'C');
        $this->fpdf->Cell(30,7,'Selected/Not Selected',1,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->SetFont( 'Helvetica', 'B', 7 );
        $this->fpdf->Cell(8,7,'',1,0,'C');
        $this->fpdf->Cell(30,7,'',1,0,'C');
        $this->fpdf->Cell(38,7,'',1,0,'C');
        $this->fpdf->Cell(18,7,'',1,0,'C');
        $this->fpdf->Cell(8,7,'',1,0,'C');
        $this->fpdf->Cell(20,7,'',1,0,'C');
        $this->fpdf->Cell(15,7,'Org Verfied',1,0,'C');
        $this->fpdf->Cell(15,7,'Org Verfied',1,0,'C');
        $this->fpdf->Cell(15,7,'Org Verfied',1,0,'C');
        $this->fpdf->Cell(15,7,'Org Verified',1,0,'C');
        $this->fpdf->Cell(15,7,'Org Verified',1,0,'C');
        $this->fpdf->Cell(20,7,'Org Verified',1,0,'C');
        $this->fpdf->Cell(38,7,'',1,0,'C');
        $this->fpdf->Cell(30,7,'',1,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->SetFont( 'Helvetica', 'B', 7 );
        $this->fpdf->Cell(8,7,'',1,0,'C');
        $this->fpdf->Cell(30,7,'',1,0,'C');
        $this->fpdf->Cell(38,7,'',1,0,'C');
        $this->fpdf->Cell(18,7,'',1,0,'C');
        $this->fpdf->Cell(8,7,'',1,0,'C');
        $this->fpdf->Cell(20,7,'',1,0,'C');
        $this->fpdf->Cell(15,7,'Yes / No',1,0,'C');
        $this->fpdf->Cell(15,7,'Yes / No',1,0,'C');
        $this->fpdf->Cell(15,7,'Yes / No',1,0,'C');
        $this->fpdf->Cell(15,7,'Yes / No',1,0,'C');
        $this->fpdf->Cell(15,7,'Yes / No',1,0,'C');
        $this->fpdf->Cell(20,7,'Yes / No',1,0,'C');
        $this->fpdf->Cell(38,7,'',1,0,'C');
        $this->fpdf->Cell(30,7,'',1,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->SetFont( 'Helvetica', 'B', 8 );
        $count = 1;
        $offset = 11;
        $pageno = 1;
        foreach($studentDatas as $studentData){

            if( $count ==  $offset){
                $this->fpdf->AddPage('L');
                $this->fpdf->SetFont( 'Helvetica', 'B', 10 );
            }
            $trn = "";

            if(!is_null($studentData->challonno) && !is_null($studentData->transno)){
                $trn = $studentData->transno." / ".$studentData->challonno;
            }else if(!is_null($studentData->challonno) && is_null($studentData->transno)){
                $trn = $studentData->challonno;
            }else if(is_null($studentData->challonno) && !is_null($studentData->transno)){
                $trn = $studentData->transno;
            }else{
                $trn = $studentData->transno;
            }

            $this->fpdf->Cell(8,7,$count++,1);
            $this->fpdf->Cell(30,7,$studentData->arrn_number,1,0,'C');
            $this->fpdf->Cell(38,7,$studentData->fullname,1);
            $this->fpdf->Cell(18,7,$studentData->mobile1,1);
            $this->fpdf->Cell(8,7,$studentData->age,1,0,'C');
            $this->fpdf->Cell(20,7,$studentData->aadhar,1,0,'C');
            $this->fpdf->Cell(15,7,'',1);
            $this->fpdf->Cell(15,7,'',1);
            $this->fpdf->Cell(15,7,'',1);
            $this->fpdf->Cell(15,7,'',1);
            $this->fpdf->Cell(15,7,'',1);
            $this->fpdf->Cell(20,7,'',1);
            $this->fpdf->Cell(38,7, $trn ,1);
            $this->fpdf->Cell(30,7,'',1,0);
            $this->fpdf->Ln();

            if( $count ==  $offset){
                $this->fpdf->Ln();
                $this->fpdf->Cell(100,5,'ICM Manager / Incharge:',0,0);
                $this->fpdf->Ln();
                $this->fpdf->Cell(100,5,'Signature :',0,0);
                $this->fpdf->Ln();
                $this->fpdf->Cell(100,5,'Principal / Incharge:',0,0);
                $this->fpdf->Ln();
                $this->fpdf->Cell(100,5,'Signature :',0,0);
                $this->fpdf->Ln();
                $this->fpdf->Cell(38,5,'Submitted for Selection committee approved:',0,0);
                $this->fpdf->Ln();
                $this->fpdf->Cell(45,5,'Committee Mem Designation:',0,0);
                $this->fpdf->Cell(38,5,'1. :',0,0);
                $this->fpdf->Cell(38,5,'2. :',0,0);
                $this->fpdf->Cell(38,5,'3. :',0,0);
                $this->fpdf->Cell(38,5,'4. :',0,0);
                $this->fpdf->Cell(38,5,'5. :',0,0);
                $this->fpdf->Cell(38,5,'6. :',0,0);
                $this->fpdf->Ln();
                $this->fpdf->Cell(38,5,'Signature :',0,0);
                $this->fpdf->Ln();
                $this->fpdf->Cell(100,5,'Chairman Designation:',0,0);
                $this->fpdf->Ln();
                $this->fpdf->Cell(100,5,'Signature :',0,0);
                $this->fpdf->Ln();
                $this->fpdf->Cell(500,5,'Page No: '.$pageno,0,0,'C');
                $this->fpdf->Ln();

                if($offset == 10){
                    $offset = $offset+5;
                }else{
                    $offset = $offset+17;
                }
                $pageno = $pageno+1;
            }
            
        }

        
        $this->fpdf->Cell(38,7,'Note:',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'1. Verified all orginal certificate of candidate',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'2. Tc,Community,10th,12th,Degree,PG Marksheet orginal are verified',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'3. Original challan / UPI Transaction no verified',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(100,5,'ICM Manager / Incharge:',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(100,5,'Signature :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(100,5,'Principal / Incharge:',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(100,5,'Signature :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'Submitted for Selection committee approved:',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(45,7,'Committee Mem Designation:',0,0);
        $this->fpdf->Cell(38,7,'1. :',0,0);
        $this->fpdf->Cell(38,7,'2. :',0,0);
        $this->fpdf->Cell(38,7,'3. :',0,0);
        $this->fpdf->Cell(38,7,'4. :',0,0);
        $this->fpdf->Cell(38,7,'5. :',0,0);
        $this->fpdf->Cell(38,7,'6. :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(38,7,'Signature :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(100,5,'Chairman Designation:',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(100,5,'Signature :',0,0);
        $this->fpdf->Ln();
        $this->fpdf->Cell(500,5,'Page No: '.$pageno,0,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->Ln();
       
        $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->Ln();
       

        // Define the file path where you want to save the PDF
        $filePath = 'uploads/applications/'.$studentDatas[0]->mtr_icm->icm_name."-".$request->gender.".pdf"; // Replace with your desired file path and name

        // Output the PDF to the specified file path
        $this->fpdf->Output($filePath, 'F');
        //Set the appropriate headers for file download
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        // Provide the file as a download response
        return response()->download($filePath, $studentDatas[0]->mtr_icm->icm_name."-".$request->gender.".pdf", $headers);
        exit;
    }


}
