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
use Codedge\Fpdf\Fpdf\Fpdf;
use DB;
use DomPDF;
use Barryvdh\DomPDF\Facade\Pdf;


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

        $invoicedetails = Invoice::where('student_id', $request->student_id)->sum('amount');

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

            $indterm = Invoice::where('student_id', $request->student_id)->where('term', $term[$i])->get();

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

        for($i=0;$i<count($term);$i++){
            $invoice = new Invoice;
            $invoice->invoiceNo = $invoiceNo;
            $invoice->payment_mode = $payment_mode;
            $invoice->student_id = $request->student_id;
            $invoice->term = $term[$i];
            $invoice->amount = $termtotal[$i];
            $invoice->save();
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
        return redirect('/icm/printinvoice/'.$invoiceNo);

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
        ->groupBy('invoiceNo','fullname','admission_number','aadhar')
        ->get();

        $totalcount = DB::table('invoice')
        ->selectRaw('DISTINCT(invoiceNo)')
        ->leftJoin('student_params', 'invoice.student_id', '=', 'student_params.id')
        ->where('student_params.icm','=',$request->icm_id)
        ->distinct()->count();

        $totalamount = DB::table('invoice')
        ->leftJoin('student_params', 'invoice.student_id', '=', 'student_params.id')
        ->where('student_params.icm','=',$request->icm_id)
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
