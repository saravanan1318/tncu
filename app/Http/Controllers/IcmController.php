<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Support\Facades\Log;
use Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentParams;
use App\Models\Invoice;
use App\Models\Invoice_Deleted;
use App\Models\Mtr_Icm;
use App\Models\Payment_log;
use App\Models\Payments;
use Codedge\Fpdf\Fpdf\Fpdf;
use DB;
use DomPDF;
use Barryvdh\DomPDF\Facade\Pdf;
use io\billdesk\client\hmacsha256\BillDeskJWEHS256Client;
use io\billdesk\client\Logging;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use App;

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


    function otpscreen(){
        return view("icm.otpscreen");
    }

    function verifyotp(Request $request){

        $validated = $request->validate([
            'otp' => 'required'
        ]);

        if(Auth::user()->otp_sent == $request->otp){

            User::where('id', Auth::user()->id)
            ->update(['otp_verified' => 1]);

            return redirect()->intended('/student/paymentview')
            ->withSuccess('Signed in');
        }else{
            return redirect('/icm/otpscreen')->with('error', 'OTP entered is not valid');
        }
    }

    function dashboard(){

        if(Auth::user()->role == 1){

            $allapplication = StudentParams::where('status',"<>", 2)->count();
            $pendingapplication = StudentParams::where('status', 0)->count();
            $selectedapplication = StudentParams::where('status', 1)->count();
            // $studentDatas = DB::table('mtr_icm')
            // ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            // ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            // ->where('student_params.status',0)
            // ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            // ->get();

            $studentDatas = DB::select( DB::raw("SELECT mi.id,mi.icm_name,
            (SELECT COUNT(id) FROM student_params WHERE icm =  mi.id)
            AS total,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 1 AND icm =  mi.id)
            AS selected,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 0 AND icm =  mi.id)
            AS notselected,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 2 AND icm =  mi.id)
            AS duplicate
            FROM mtr_icm AS mi") );

            $totalcount = Invoice::select('invoiceNo')->distinct()->count();
            $totalamount = Invoice::sum('amount');

        }else{

            $allapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status',"<>", 2)->count();
            $pendingapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status', 0)->count();
            $selectedapplication = StudentParams::where('icm', Auth::user()->icm_id)->where('status', 1)->count();
            // $studentDatas = DB::table('mtr_icm')
            // ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            // ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            // ->where('student_params.icm',Auth::user()->icm_id)
            // ->where('student_params.status',0)
            // ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            // ->get();

            $studentDatas = DB::select( DB::raw("SELECT mi.id,mi.icm_name,
            (SELECT COUNT(id) FROM student_params WHERE icm =  mi.id)
            AS total,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 1 AND icm =  mi.id)
            AS selected,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 0 AND icm =  mi.id)
            AS notselected,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 2 AND icm =  mi.id)
            AS duplicate
            FROM mtr_icm AS mi WHERE mi.id = ".Auth::user()->icm_id) );

            $totalcount = DB::table('invoice')
            ->selectRaw('DISTINCT(invoiceNo)')
            ->leftJoin('student_params', 'invoice.student_id', '=', 'student_params.id')
            ->where('student_params.icm','=',Auth::user()->icm_id)
            ->distinct()->count();

            $totalamount = DB::table('invoice')
            ->leftJoin('student_params', 'invoice.student_id', '=', 'student_params.id')
            ->where('student_params.icm','=',Auth::user()->icm_id)
            ->sum('invoice.amount');

        }

        

        $data[] = [
           "allapplication" =>  $allapplication,
           "pendingapplication" =>  $pendingapplication,
           "selectedapplication" =>  $selectedapplication,
           "totalcount" =>  $totalcount,
           "totalamount" =>  $totalamount
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

        // $studentDatas = DB::table('mtr_icm')
        // ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
        // ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
        // ->where('student_params.status',0)
        // ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
        // ->get();

        $studentDatas = DB::select( DB::raw("SELECT mi.id,mi.icm_name,
        (SELECT COUNT(id) FROM student_params WHERE icm =  mi.id)
        AS total,
        (SELECT COUNT(id) FROM student_params WHERE STATUS = 1 AND icm =  mi.id)
        AS selected,
        (SELECT COUNT(id) FROM student_params WHERE STATUS = 0 AND icm =  mi.id)
        AS notselected,
        (SELECT COUNT(id) FROM student_params WHERE STATUS = 2 AND icm =  mi.id)
        AS duplicate
        FROM mtr_icm AS mi WHERE mi.id = ".Auth::user()->icm_id) );
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


            $studentDatas = DB::select( DB::raw('SELECT mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps,
            (SELECT COUNT(student_params.icm) FROM student_params WHERE STATUS = 1 AND gender = "Male" AND icm = mtr_icm.id) AS malecount,
            (SELECT COUNT(student_params.icm) FROM student_params WHERE STATUS = 1 AND gender = "Female" AND icm = mtr_icm.id) AS femalecount 
            FROM mtr_icm
            LEFT JOIN student_params ON mtr_icm.id = student_params.icm
            WHERE student_params.status = 1 GROUP BY student_params.icm,mtr_icm.icm_name,mtr_icm.id') );

        }else{

            $studentDatas = DB::select( DB::raw('SELECT mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps,
            (SELECT COUNT(student_params.icm) FROM student_params WHERE STATUS = 1 AND gender = "Male" AND icm = mtr_icm.id) AS malecount,
            (SELECT COUNT(student_params.icm) FROM student_params WHERE STATUS = 1 AND gender = "Female" AND icm = mtr_icm.id) AS femalecount 
            FROM mtr_icm
            LEFT JOIN student_params ON mtr_icm.id = student_params.icm
            WHERE student_params.status = 1 AND mtr_icm.id = '.Auth::user()->icm_id.' GROUP BY student_params.icm,mtr_icm.icm_name,mtr_icm.id') );


        }

        return view("icm.selectedapplicationlistmale", compact('studentDatas'));
    }


    function selectedapplicationlistgendericm(Request $request){

        $studentDatas = StudentParams::where('icm', $request->icm_id)->where('gender', $request->gender)->where('status',1)->get();


        return view("icm.selectedapplicationlist", compact('studentDatas'));
    }

    function selectedapplicationlist(Request $request){

        $studentDatas = StudentParams::where('icm', $request->icm_id)->where('status', 1)->get();


        return view("icm.selectedapplicationlistnew", compact('studentDatas'));
    }

    function notselectedapplicationlist(Request $request){

        $studentDatas = StudentParams::where('icm', $request->icm_id)->where('status', 0)->get();


        return view("icm.notselectedapplicationlist", compact('studentDatas'));
    }

    function duplicatedapplicationlist(Request $request){

        $studentDatas = StudentParams::where('icm', $request->icm_id)->where('status', 2)->get();


        return view("icm.duplicatedapplicationlist", compact('studentDatas'));
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

    function  unselectedlist(Request $request){
        $selectedCheckboxes = $request->input('selectedCheckboxes');

        $message = "";
        $offset = 0;
        foreach($selectedCheckboxes as $selectedCheckboxe){       
            $studentDatas1 = StudentParams::where('id', $selectedCheckboxe)->where('status', 0)->first();
            if($studentDatas1)
            {
                $studentDatas = StudentParams::where('aadhar', $studentDatas1['aadhar'])->first();
                if($studentDatas){
                    unset($selectedCheckboxes[$offset]);
                    $message .= $studentDatas->aadhar.", ";
                }
            }

            $studentDatas2 = Invoice::where('student_id', $selectedCheckboxe)->first();
            if($studentDatas2)
            {
                $studentDatas = StudentParams::where('id', $studentDatas2['student_id'])->first();
                if($studentDatas){
                    unset($selectedCheckboxes[$offset]);
                    $message .= $studentDatas->aadhar.", ";
                }
            }

        }

        if(!empty($message)){
            $message = $message." Adhaar already not selected or paid term fees";
        }else{
            $message = "Status updated successfully";
        }

        // Update the status for the selected IDs to 1
        StudentParams::whereIn('id', $selectedCheckboxes)
            ->update(['status' => 0]);

        // Optionally, you can return a response
        return response()->json(['message' => $message]);
    }

    function  printerversionmale(Request $request){


        if(Auth::user()->role == 1){

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=','Male')
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }else{

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=','Male')
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
            ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            ->get();

        }else{

            $studentDatas = DB::table('mtr_icm')
            ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            ->where('student_params.gender','=','Female')
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

            $studentDatas = DB::select( DB::raw("SELECT mi.id,mi.icm_name,
            (SELECT COUNT(id) FROM student_params WHERE gender = '".$gender."' AND icm =  mi.id)
            AS total,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 1 AND gender = '".$gender."' AND icm =  mi.id)
            AS selected,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 0 AND gender = '".$gender."' AND icm =  mi.id)
            AS notselected,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 2 AND gender = '".$gender."' AND icm =  mi.id)
            AS duplicate
            FROM mtr_icm AS mi") );

            // $studentDatas = DB::table('mtr_icm')
            // ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            // ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            // ->where('student_params.gender','=',$gender)
            // ->where('student_params.status',0)
            // ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            // ->get();

        }else{

            // $studentDatas = DB::table('mtr_icm')
            // ->selectRaw('mtr_icm.id, mtr_icm.icm_name, COUNT(student_params.icm) AS Noofapps')
            // ->leftJoin('student_params', 'mtr_icm.id', '=', 'student_params.icm')
            // ->where('student_params.gender','=',$gender)
            // ->where('student_params.status',0)
            // ->where('student_params.icm','=',Auth::user()->icm_id)
            // ->groupBy('student_params.icm','mtr_icm.icm_name','mtr_icm.id')
            // ->get();

            $studentDatas = DB::select( DB::raw("SELECT mi.id,mi.icm_name,
            (SELECT COUNT(id) FROM student_params WHERE gender = '".$gender."' AND icm =  mi.id)
            AS total,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 1 AND gender = '".$gender."' AND icm =  mi.id)
            AS selected,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 0 AND gender = '".$gender."' AND icm =  mi.id)
            AS notselected,
            (SELECT COUNT(id) FROM student_params WHERE STATUS = 2 AND gender = '".$gender."' AND icm =  mi.id)
            AS duplicate
            FROM mtr_icm AS mi WHERE mi.id = ".Auth::user()->icm_id) );


        }

        return view("icm.contacticmlist",compact('studentDatas','gender'));

    }

    function  contacticmapplicationlist(Request $request){
        
        if($request->status == 'all'){

            $studentDatas = StudentParams::where('icm', $request->icm_id)->where('gender',$request->gender)->get();

        }else{
            $studentDatas = StudentParams::where('icm', $request->icm_id)->where('gender',$request->gender)->where('status',$request->status)->get();

        }


        // $html = '<!DOCTYPE html> <html> <head> <style> table { font-family: arial, sans-serif; border-collapse: collapse; width: 100%; font-size: 8px; } td { border: 1px solid #dddddd; text-align: left; padding: 20px; } tr:nth-child(even) { background-color: #dddddd; } h3,h4,.slno{ text-align: center; } th{ background-color: black; color: #fff; text-align: center; border: 1px solid #dddddd; padding: 20px; font-size: 10px !important;} </style> </head> <body> <h3>CONTACT DETAILS OF DIPLOMA IN COOPERATIVE MANAGEMENT 2023-24</h3> <h4>Tamil Nadu Cooperative Union</h4> <h4>'.$studentDatas[0]->mtr_icm->icm_name.'</h4> <table> <tr> <th style="width:5%" class="slno">SlNo</th> <th style="width:15%">ARN Number</th> <th style="width:20%">Full name</th> <th style="width:10%">MobileNo</th><th style="width:50%">Address</th> </tr> <tbody>';
        
        // $count = 1;
        // foreach($studentDatas as $studentData){
        //     $address = $studentData->plotno.", ".$studentData->streetname.", ".$studentData->city.", ".$studentData->district.", ".$studentData->state.", ".$studentData->pincode;

        //     $html .= '<tr>
        //     <td style="width:5%" class="slno">'.$count++.'</td>
        //     <td style="width:15%" class="slno">'.$studentData->arrn_number.'</td>
        //     <td style="width:20%" class="slno">'.$studentData->fullname.'</td>
        //     <td style="width:10%" class="slno">'.$studentData->mobile1.'</td>
        //     <td style="width:50%" class="slno">'.$address.'</td>
        //   </tr>';
        // }

        // $html .= '</tbody></table></body></html>';
        
        $filenametodownload = $studentDatas[0]->mtr_icm->icm_name."-".$request->status."_contact.pdf";
        // PDF::SetTitle('Hello World');
        // PDF::AddPage();
        // PDF::writeHTML($html, true, false, true, false, '');

        // PDF::Output($filenametodownload);

        $pdf = Pdf::loadView('icm.contacticmapplicationlistdownload',compact('studentDatas'));

        return $pdf->download($filenametodownload);

        
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

    function generateinvoice(){
        
        if(Auth::user()->role == 1){
            $studentDatas = StudentParams::select('id','arrn_number')->where('status',1)->get();
        }else{
            $studentDatas = StudentParams::select('id','arrn_number')->where('icm', Auth::user()->icm_id)->where('status',1)->get();
        }

        $icm = Mtr_icm::where('id',Auth::user()->icm_id)->first();

        return view("icm.generateinvoice",compact('studentDatas','icm'));
    }

    function storeinvoice(Request $request){

        $student_id = $request->student_id;

        $invoicedetails = Invoice::where('student_id', $request->student_id)->where('payment_status', 1)->sum('amount');

        if($invoicedetails > 18750 || $invoicedetails == 18750){
            return redirect()->back()->with('error', 'Already paid the full amount');
        }

        //dd($invoicedetails);
        $term = $request->term;
        $termamount = $request->termamount;
        $termtotal = $request->termtotal;
        $payment_mode = $request->payment_mode;

        $actualinv = Auth::user()->invoiceNo+1;
        $invoiceNo = 'INV'.Auth::user()->id.'-'.Auth::user()->invoiceNo+1;
        $reqtotal = 0;
        for($i=0;$i<count($term);$i++){

            $indterm = Invoice::where('student_id', $request->student_id)->where('term', $term[$i])->where('payment_status', 1)->get();

            if(count($indterm) > 0){
              //  return redirect()->back()->with('error', 'Already '.$indterm[0]->term.' paid with amount '.$indterm[0]->amount);
            }
            $reqtotal += $termtotal[$i];
        }
        $total = $reqtotal + $invoicedetails;
        $remaining = 18750 - $invoicedetails;
       // dd($total);
        if($reqtotal > 18750){
            return redirect()->back()->with('error', 'Total amount should not exceed 18,750 ');
        }
        if($total > 18750){
            return redirect()->back()->with('error', 'Student Already paid '.$invoicedetails.' amount remaining balance to pay '.$remaining);
        }

        $online = 0;
        $student_id = 0;
        for($i=0;$i<count($term);$i++){
            $invoice = new Invoice;
            $invoice->invoiceNo = $invoiceNo;
            $invoice->payment_mode = $payment_mode;
            $invoice->student_id = $request->student_id;
            $invoice->term = $term[$i];

            if( $invoice->payment_mode == "ONLINE"){
                $invoice->payment_status = 0;
                $online = 1;
            }else{
                $invoice->payment_status = 1;
            }

            $invoice->amount = $termtotal[$i];
           
            $invoice->save();

            $student_id = $request->student_id;
        }

        $user = User::where('id',Auth::user()->id)->first();
        $user->invoiceNo = $actualinv;
        $user->update();

        $student = StudentParams::where('id',$request->student_id)->first();
       
        if(is_null($student->admission_number) || empty($student->admission_number)){

            $gender = "F";

            if($student->gender == "Male"){
                $gender = "M";
            }
    
            $icmname = Mtr_icm::where('id',$student->icm)->first();
            $short_name =  $icmname['short_name'];
            $admission_count =  $icmname['admission_count'];
            $admission_number = $short_name.date("Y").$gender.'AN'.sprintf("%03d", $admission_count);
            $student->admission_number = $admission_number;
            $student->update();

            $icmname->admission_count = $admission_count+1;
            $icmname->update();
        }

        if($online == 1){
            return redirect('/icm/paymentverify/'.$student_id.'/'.$invoiceNo);
        }else{
            return redirect('/icm/printinvoice/'.$invoiceNo);
        }

    }

    function paymentverify(Request $request){


        $studentDatas = StudentParams::select('id','arrn_number','user_id')->where('id', $request->student_id)->where('status',1)->get();
        $user_id = $studentDatas[0]['user_id'];
        $icm = Mtr_icm::where('id',Auth::user()->icm_id)->first();

        $invoicedetails = Invoice::where('invoiceNo', $request->invoiceNo)->get();
        $amount = Invoice::where('invoiceNo', $request->invoiceNo)->sum("amount");
        $invoiceNo = $request->invoiceNo;
        $invoiceDate = $invoicedetails[0]['created_at'];
        $student_id = $request->student_id;

        $amountpaid = Invoice::where('student_id', $student_id)->where('payment_status', 1)->sum('amount');
        $balancetopay = 18750 - $amountpaid;
        if($balancetopay < 0){
            $balancetopay = 0;
        }
        if($amountpaid == 0){
            $amountpaid = "NA";
        }else{
            $amountpaid = $this->moneyFormatIndia($amountpaid);
        }
       
        return view("icm.paymentverify",compact('studentDatas','icm','amount','invoiceNo','invoiceDate','amountpaid','balancetopay','user_id'));

    }

    function moneyFormatIndia($num) {
        $explrestunits = "" ;
        if(strlen($num)>3) {
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++) {
                // creates each of the 2's group and adds a comma to the end
                if($i==0) {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                } else {
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }

    function payment(Request $request)
    {

        $invoiceNo = $request->invoiceNo;
        $amount=0;
        $amount = Invoice::where('invoiceNo', $request->invoiceNo)->sum('amount');
        $student=StudentParams::where("status",'1')->where("user_id",$request->user_id)->get();
        if(count($student)==1) {
            $MerchantID = "TMLNDUCOUN";
            $ClientID = "tmlnducoun";
            $responseurl = "https://tncuicm.com/student/paymentresponse";
          //  $secretkey = 'Cjlj6qiBlQ7qdnglXvlJCKY1t3rNk7x4';  //Developement
            $secretkey = 'nBxE5Uw4i0hGZQia2dETrVAV1KrxALaB';  //Production
            $returnURL = "https://tncuicm.com/student/paymentreturn";
            $billdesk_URL = "https://api.billdesk.com/payments/ve1_2/orders/create";
            $transaction_id=$student[0]->arrn_number."-".time();
            $totalamount=$amount;
            $date_atom =date("dd-mm-yyyy h:i:s");
            $StudentID=$student[0]->id;
            $userId=$student[0]->user_id;
            $PaymentFor=$amount;
            $ipaddress= $_SERVER['REMOTE_ADDR'];

            $clientID = $ClientID;
            $secretKey = $secretkey;
            $merchantID = $MerchantID;

    // Create the client and set up logging
            $client = new BillDeskJWEHS256Client("https://api.billdesk.com", $clientID, $secretKey);
            $logger = new Logger("default");
            $logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
            $client->setLogger($logger);

    // Prepare the request data
           
            $request = array(
                'mercid' => $merchantID,
                'orderid' => $StudentID.'-2023-LIVE'.time(),
                'amount' => $totalamount,
                'order_date' => date_format(new \DateTime(), DATE_W3C),
                'currency' => "356",
                'ru' => "https://tncuicm.com/student/paymentresponse",
                'additional_info' => array(
                    "additional_info1" => $userId, //userId
                    "additional_info2" =>  $student[0]->email, // student Email
                    "additional_info3" =>  $amount, // student selecting and Term payments
                    "additional_info4" => Auth::user()->icm_id, // student ICM ID
                    "additional_info5" => "NA",
                    "additional_info6" =>  "NA",
                    "additional_info7" => $invoiceNo,
                ),
                'itemcode' => "DIRECT",
                'device' => array(
                    'init_channel' => 'internet',
                    'ip' => "$ipaddress",
                    'user_agent' => 'Mozilla/5.0'
                )
            );

            $paymentRequest= new Payment_log();
            $paymentRequest->userid=$userId;
            $paymentRequest->sendPayload = json_encode($request);
            $paymentRequest->save();
            $lastInsertId = $paymentRequest->id;
            $request["additional_info"]["additional_info5"]=$lastInsertId;//payment log-id
            $paymentRequest = Payment_log::find($lastInsertId);
            $paymentRequest->sendPayload=$request;
            $paymentRequest->save();
    // Call the createOrder API

            $payments= new Payments();
            $payments->student_id = $StudentID;
            $payments->user_id = $userId;
            $payments->invno = $invoiceNo;
            $payments->mercid = $merchantID;
            $payments->orderid = $StudentID.'-2023-LIVE'.time();
            $payments->amount = $totalamount;
            $payments->order_date = date("Y-m-d");
            $payments->status = "INITIATED";
            $payments->save();

            $request["additional_info"]["additional_info6"]= $payments->id;//payment log-id

            $response = $client->createOrder($request);

            $getinvoice = Invoice::where('invoiceNo', $invoiceNo)->first();
            $getinvoice->payment_id = $payments->id;
            $getinvoice->update();

    // Handle the response as needed
            if ($response->getResponseStatus() === 200) {
                // Success
                $responseData = $response->getResponse();
                $paymentLogresponse = Payment_log::find($lastInsertId);
                $paymentLogresponse->createapiresponse = json_encode($responseData);
                $paymentLogresponse->save();

                $bdorderid=$responseData->bdorderid;
                $authToken=$responseData->links[1]->headers->authorization;
                $returnUrl=$responseData->ru;
                $tmp=[];
                $tmp["status"]="SUCCESS";
                $tmp["merchantID"]=$merchantID;
                $tmp["bdorderid"]=$bdorderid;
                $tmp["authToken"]=$authToken;
                $tmp["returnUrl"]=$returnUrl;
                $returndata=json_encode($tmp);
            } else {
                // Handle the error
                $responseData = $response->getResponse();
                $tmp=[];
                $tmp["status"]="ERROR";
                $tmp["message"]=$responseData->message;
                $tmp["error_code"]=$responseData->error_code;
                $tmp["error_type"]=$responseData->error_type;
                $returndata=json_encode($tmp);
                // Process $errorResponse here
            }

            
        }
        else{
            $tmp=[];
            $tmp["status"]="ERROR";
            $tmp["message"]="you are facing dome issue please contact admin!";
            $returndata=json_encode($tmp);
        }

        return $returndata;
    }

    function paymentresponse(Request $request)
    {

        App::setLocale("en");

        $token= $request->transaction_response;
        $tokenParts = explode('.', $token);

        if (count($tokenParts) !== 3) {
            // Invalid JWT format
            return null;
        }
        list($header, $payload, $signature) = $tokenParts;
        // Base64 decode the parts
        $decodedHeader = base64_decode($header);
        $decodedPayload = base64_decode($payload);

        // JSON decode the decoded parts
        $headerData = json_decode($decodedHeader, true);
        $payloadData = json_decode($decodedPayload, true);
//        return json_encode($payloadData);
        $paymentlogs=Payment_log::find($payloadData["additional_info"]["additional_info5"]);
        $payment_id = $payloadData["additional_info"]["additional_info6"];
        $paymentlogs ->response = $token;
        $paymentlogs->save();
        if($payloadData["transaction_error_type"]=="success" && $payloadData["auth_status"]== "0300" ){
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];

            $Student = User::where('id', $userid)
                ->first();
            if ($Student) {

                $returnMessage="SUCCESS";
                $transaction_date=$payloadData["transaction_date"];
                $transactionid=$payloadData["transactionid"];
                $amount=$payloadData["amount"];

                $invoiceNo = $payloadData["additional_info"]["additional_info7"];

                $invoicedetails = Invoice::where('invoiceNo', $invoiceNo)->get();
                $studentData = StudentParams::where('id', $invoicedetails[0]->student_id)->first();
                $icm = Mtr_icm::where('id',$studentData->icm)->first();

                $payments = Payments::where('id', $payment_id)->first();
                $payments->status = $returnMessage;
                $payments->transaction_date = $payloadData["transaction_date"];
                $payments->transactionid = $payloadData["transactionid"];
                $payments->update();
        
                $data['invoicedetails'] = $invoicedetails;
                $data['studentData'] = $studentData;
                $data['icm'] = $icm;                       

                $result = (new PHPMailerController)->composepaymentEmail($invoicedetails[0]->student_id,$payment_id);

                $amount = $payments->amount;
                $arrn_number =  $studentData->arrn_number;
                $mobilenumber =   $studentData->mobile1;
                $TEMPLATE_ID = __('smstemplate.application_templateid');
                $TEMPLATE_ID = __('1107169417053603936');
                $SMSAPIKEY = env("SMSAPIKEY");
                $SMSAPIKEY = "jUdpsmb5V7WIR8zdirW+By1lzoxHFgunMlUwJsjz70g=";
                //$SMSCLIENTID = env("SMSCLIENTID");
                $SMSCLIENTID = "1c590c3e-ac8b-495a-a355-d184b432a9e8";
                
                $message = __('smstemplate.payment_success');
                $message = str_replace("{var1}",$amount,$message);
                $message = str_replace("{var2}",$arrn_number,$message);
                $curl = curl_init();

                Log::info("http://sms.dial4sms.com/api/v2/SendSMS?SenderId=TNCUCO&Message='.urlencode($message).'&MobileNumbers='.$mobilenumber.'&TemplateId='.urlencode($TEMPLATE_ID).'&ApiKey='.urlencode($SMSAPIKEY).'&ClientId='.urlencode($SMSCLIENTID)");
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://sms.dial4sms.com/api/v2/SendSMS?SenderId=TNCUCO&Message='.urlencode($message).'&MobileNumbers='.$mobilenumber.'&TemplateId='.urlencode($TEMPLATE_ID).'&ApiKey='.urlencode($SMSAPIKEY).'&ClientId='.urlencode($SMSCLIENTID),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);
                Log::info("**response**");
                Log::info($response);

                curl_close($curl);

                $invoiceupdate = Invoice::where('invoiceNo', $invoiceNo)->first();
                $invoiceupdate->payment_status = 1;
                $invoiceupdate->update();

                

                return   view("student.paymentstatus" ,compact("returnMessage" , "transactionid","transaction_date","amount","invoiceNo"));
            } else {
                return back()->withErrors(['email' => 'Invalid credentials']); // Authentication failed
            }

        }
        elseif ($payloadData["auth_status"]== "0002")
        {
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];


            $Student = User::where('id', $userid)
                ->first();
            Auth::login($Student);
            $returnMessage="ERROR";
            $transaction_date=$payloadData["transaction_date"];
            $transactionid=$payloadData["transactionid"];
            $amount=$payloadData["amount"];

            $payments = Payments::where('id', $payment_id)->first();
            $payments->status = $returnMessage;
            $payments->transaction_date = $payloadData["transaction_date"];
            $payments->transactionid = $payloadData["transactionid"];
            $payments->update();
            
            return   view("icm.paymentverify" ,compact("returnMessage","transaction_date","transactionid","amount"));

        }
        elseif ($payloadData["auth_status"]== "0399")
        {
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];

            $Student = User::where('id', $userid)
                ->first();
            Auth::login($Student);
            $returnMessage="ERROR";
            $transaction_date=$payloadData["transaction_date"];
            $transactionid=$payloadData["transactionid"];
            $amount=$payloadData["amount"];

            $payments = Payments::where('id', $payment_id)->first();
            $payments->status = $returnMessage;
            $payments->transaction_date = $payloadData["transaction_date"];
            $payments->transactionid = $payloadData["transactionid"];
            $payments->update();

            return   view("icm.paymentverify" ,compact("returnMessage","transaction_date","transactionid","amount"));

        }
        else{
            $userid=$payloadData["additional_info"]["additional_info1"];
            $studentEmail =$payloadData["additional_info"]["additional_info2"];
            $termdetails =$payloadData["additional_info"]["additional_info3"];
            $termdetails= explode(",",$termdetails);
            $ICM_ID= $payloadData["additional_info"]["additional_info4"];

            $Student = User::where('id', $userid)
                ->first();
            Auth::login($Student);
            $returnMessage="ERROR";

            $payments = Payments::where('id', $payment_id)->first();
            $payments->status = $returnMessage;
            $payments->update();

            return   view("icm.paymentverify" ,compact("returnMessage"));
        }


//        return $decodedPayload;

    }

    function editinvoice(Request $request){
        
        if(Auth::user()->role == 1){
            $studentDatas = StudentParams::select('id','arrn_number')->where('status',1)->get();
        }else{
            $studentDatas = StudentParams::select('id','arrn_number')->where('icm', Auth::user()->icm_id)->where('status',1)->get();
        }

        $invoiceNo = $request->invoiceNo;
        $invoicedetails = Invoice::where('invoiceNo', $request->invoiceNo)->get();
        $StudentParams = StudentParams::where('id', $invoicedetails[0]->student_id)->first();
        $icm = Mtr_icm::where('id',$StudentParams->icm)->first();

        return view("icm.editinvoice",compact('studentDatas','icm','invoicedetails','StudentParams','invoiceNo'));
    }

    function updateinvoice(Request $request){

        $student_id = $request->student_id;
        $invoiceNo = $request->invoiceNo;
        $invoicedetails = Invoice::where('student_id', $request->student_id)->where('invoiceNo','<>', $invoiceNo)->sum('amount');

        if($invoicedetails > 18750 || $invoicedetails == 18750){
            return redirect()->back()->with('error', 'Already paid the full amount');
        }

        //dd($invoicedetails);
        $term = $request->term;
        $termamount = $request->termamount;
        $termtotal = $request->termtotal;
        $payment_mode = $request->payment_mode;

      
        $reqtotal = 0;
        for($i=0;$i<count($term);$i++){

            
            $indterm = Invoice::where('student_id', $request->student_id)->where('invoiceNo','<>', $invoiceNo)->where('term', $term[$i])->get();

            if(count($indterm) > 0){
                return redirect()->back()->with('error', 'Already '.$indterm[0]->term.' paid with amount '.$indterm[0]->amount);
            }

            $reqtotal += $termtotal[$i];
        }
        $total = $reqtotal + $invoicedetails;
        $remaining = 18750 - $invoicedetails;
       // dd($total);
        if($reqtotal > 18750){
            return redirect()->back()->with('error', 'Total amount should not exceed 18,750 ');
        }
        if($total > 18750){
            return redirect()->back()->with('error', 'Student Already paid '.$invoicedetails.' amount remaining balance to pay '.$remaining);
        }

        Invoice::where('invoiceNo', $invoiceNo)->delete();

        for($i=0;$i<count($term);$i++){
            $invoice = new Invoice;
            $invoice->invoiceNo = $invoiceNo;
            $invoice->payment_mode = $payment_mode;
            $invoice->student_id = $request->student_id;
            $invoice->term = $term[$i];
            $invoice->amount = $termtotal[$i];
            $invoice->payment_status = 1;
            $invoice->save();
        }

        return redirect('/icm/printinvoice/'.$invoiceNo);

    }

    function printinvoiceold(Request $request){

        $invoicedetails = Invoice::where('invoiceNo', $request->invoiceNo)->get();
        $studentData = StudentParams::where('id', $invoicedetails[0]->student_id)->first();
        $icm = Mtr_icm::where('id',$studentData->icm)->first();
       
        return view("icm.printinvoice",compact('studentData','invoicedetails','icm'));
    }

    function printinvoice(Request $request){

        $invoicedetails = Invoice::where('invoiceNo', $request->invoiceNo)->get();
        $studentData = StudentParams::where('id', $invoicedetails[0]->student_id)->first();
        $icm = Mtr_icm::where('id',$studentData->icm)->first();

        $data['invoicedetails'] = $invoicedetails;
        $data['studentData'] = $studentData;
        $data['icm'] = $icm;
        $pdf = Pdf::loadView('icm.printinvoice',compact('studentData','invoicedetails','icm'));

        return $pdf->download($studentData->admission_number.'_invoice_'.$request->invoiceNo.'.pdf');

    }

    function icmwiselistfeespaid(){


        if(Auth::user()->role == 1){
            $icm = Mtr_icm::get();
        }else{
            $icm = Mtr_icm::where('id',Auth::user()->icm_id)->get();
        }

        return view("icm.icmwiselistfeespaid",compact('icm'));

    }

    function feespaid(Request $request){

        $studentDatas = DB::table('invoice')
        ->selectRaw('invoiceNo,fullname,admission_number,aadhar,SUM(invoice.amount) AS amount')
        ->leftJoin('student_params', 'invoice.student_id', '=', 'student_params.id')
        ->where('student_params.icm','=',$request->icm_id)
        ->where('invoice.payment_status',1)
        ->groupBy('invoiceNo','fullname','admission_number','aadhar')
        ->get();

        $totalcount = DB::table('invoice')
        ->selectRaw('DISTINCT(invoiceNo)')
        ->leftJoin('student_params', 'invoice.student_id', '=', 'student_params.id')
        ->where('student_params.icm','=',$request->icm_id)
        ->where('invoice.payment_status',1)
        ->distinct()->count();

        $totalamount = DB::table('invoice')
        ->leftJoin('student_params', 'invoice.student_id', '=', 'student_params.id')
        ->where('student_params.icm','=',$request->icm_id)
        ->where('invoice.payment_status',1)
        ->sum('invoice.amount');

        $icm = Mtr_icm::where('id',$request->icm_id)->first();

        return view("icm.feespaid",compact('studentDatas','icm','totalcount','totalamount'));

    }

    function invoiceview(Request $request){

        $studentDatas = DB::table('invoice')
            ->selectRaw('*')
            ->leftJoin('student_params', 'invoice.student_id', '=', 'student_params.id')
            ->where('invoice.invoiceNo','=',$request->invoiceNo)
            ->get();

        return view("icm.invoiceview",compact('studentDatas'));

    }

    function invoicedelete(Request $request){

        $invoicedelete = Invoice::where('invoiceNo', $request->invoiceNo)->get();

        foreach($invoicedelete as $invoice){
            $invoice_deleted = new Invoice_Deleted;
            $invoice_deleted->student_id = $invoice->student_id;
            $invoice_deleted->invoiceNo =  $invoice->invoiceNo;
            $invoice_deleted->payment_mode =  $invoice->payment_mode;
            $invoice_deleted->term =  $invoice->term;
            $invoice_deleted->amount =  $invoice->amount;
            $invoice_deleted->payment_id =  $invoice->payment_id;
            $invoice_deleted->payment_status =  $invoice->payment_status;
            $invoice_deleted->created_at =  $invoice->created_at;
            $invoice_deleted->updated_at =  $invoice->updated_at;
            $invoice_deleted->save();
        }
        
        Invoice::where('invoiceNo', $request->invoiceNo)->delete();

        return redirect()->back()->with('status', 'Invoice deleted successfully');

    }

    function icmwisepaidreport(Request $request){

        if(Auth::user()->role == 1){
           
            $studentDatas = DB::select( DB::raw("	SELECT mi.id,mi.icm_name,
            ( SELECT count(id) FROM student_params WHERE id IN (SELECT DISTINCT(student_id) FROM invoice) AND icm = mi.id AND STATUS = 1)
            AS paidcount,
                (SELECT COUNT(id) FROM student_params WHERE id NOT IN (SELECT DISTINCT(student_id) FROM invoice) AND icm =  mi.id AND STATUS = 1)
            AS notpaidcount,
            (SELECT SUM(amount) FROM invoice WHERE student_id IN (SELECT id FROM student_params WHERE icm = mi.id))
            AS amount
            FROM mtr_icm AS mi") );

        }else{
           
            $studentDatas = DB::select( DB::raw("	SELECT mi.id,mi.icm_name,
            ( SELECT count(id) FROM student_params WHERE id IN (SELECT DISTINCT(student_id) FROM invoice) AND icm = mi.id AND STATUS = 1)
            AS paidcount,
                (SELECT COUNT(id) FROM student_params WHERE id NOT IN (SELECT DISTINCT(student_id) FROM invoice) AND icm =  mi.id AND STATUS = 1)
            AS notpaidcount,
            (SELECT SUM(amount) FROM invoice WHERE student_id IN (SELECT id FROM student_params WHERE icm = mi.id))
            AS amount
            FROM mtr_icm AS mi WHERE mi.id = '".Auth::user()->icm_id."'") );
        }

       

        return view("icm.icmwisepaidreport",compact('studentDatas'));

    }

    function icmwisepaid(Request $request){

       // $studentDatas = DB::select( DB::raw("SELECT * FROM student_params WHERE id IN (SELECT DISTINCT(student_id) FROM invoice) AND icm =  $request->icm_id") );
        $studentDatas = DB::select( DB::raw("	SELECT *, (SELECT GROUP_CONCAT(amount) FROM invoice WHERE term = 'TUITION FESS - TERM 1' AND student_id = st.id) AS term1
        , (SELECT GROUP_CONCAT(amount) FROM invoice WHERE term = 'TUITION FESS - TERM 2' AND student_id = st.id) AS term2
        , (SELECT GROUP_CONCAT(amount) FROM invoice WHERE term = 'TUITION FESS - TERM 3' AND student_id = st.id) AS term3
        FROM student_params AS st WHERE id IN (SELECT DISTINCT(student_id) FROM invoice) AND icm =  $request->icm_id") );

        return view("icm.icmwisepaid",compact('studentDatas'));

    }

    function icmwisenotpaid(Request $request){

        $studentDatas = DB::select( DB::raw("SELECT * FROM student_params WHERE id NOT IN (SELECT DISTINCT(student_id) FROM invoice) AND icm =  $request->icm_id") );

        return view("icm.icmwisenotpaid",compact('studentDatas'));

    }


}
