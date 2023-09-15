<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentParams;
use App\Models\Mtr_Icm;
use App;
use Hash;
use Illuminate\Support\Facades\Log;
use PDF;
use Illuminate\Support\Facades\Storage;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Http;

class WebsiteController extends Controller
{
    //

    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    function index(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return view("home");

    }

    function aboutus(Request $request){
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return view("aboutus");
    }

    function notification(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return view("notification");
    }

    function applicationform(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);

        $icmlists = Mtr_Icm::orderBy("icm_name", "asc")->get();
        return view("applicationform",compact('icmlists'));
    }


    function store(Request $request){

        $Userexistcheck = User::where('email',$request->email)->where('icm_id',$request->icm)->get();

        if(count($Userexistcheck) > 0){
            return redirect()->back()->withInput($request->input())->with('error', 'Email already exist')->with('selectBox', $request->input('selectBox')) // Add select box value
            ->with('checkbox', $request->input('checkbox')) // Add checkbox value
            ->with('file', $request->file('file'));
        }
        if(StudentParams::where('aadhar', $request->aadhar)->where('icm',$request->icm)->exists()){
            return redirect()->back()->withInput($request->input())->with('error', 'Aadhar already exist')->with('selectBox', $request->input('selectBox')) // Add select box value
            ->with('checkbox', $request->input('checkbox')) // Add checkbox value
            ->with('file', $request->file('file'));
        }
        if(StudentParams::where('challonno', $request->challonno)->Where('bankname', $request->bankname)->Where('challonno','!=',NULL)->Where('paymentdistrict', $request->paymentdistrict)->exists()){
            return redirect()->back()->withInput($request->input())->with('error', 'Challon already exist')->with('selectBox', $request->input('selectBox')) // Add select box value
            ->with('checkbox', $request->input('checkbox')) // Add checkbox value
            ->with('file', $request->file('file'));;
        }

        $user = new User;
        $user->name = $request->fullname;
        $user->phone = $request->mobile1;
        $user->state = $request->state;
        $user->email = $request->icm."-".$request->email;
        $user->password = Hash::make($request->mobile1);
        $user->role = 3;
        $user->icm_id = $request->icm;
        $user->save();

        $commonpath = 'uploads';

        $communityfilename = "NA";
        if($request->file('Communityfile')) {
            $subdirectory = "/community";
            $Communityfile = $request->file('Communityfile');
            $communityfilename = time().'_'.$user->id.'_'.$Communityfile->getClientOriginalName();
            $destinationPath1 = $commonpath.$subdirectory;
            $Communityfile->move($destinationPath1,$communityfilename);
            $communityfilename = $destinationPath1.'/'.$communityfilename;
        }

        $isdifferentlyabledfilename = "NA";
        if($request->file('isdifferentlyabledfile')) {
            $subdirectory = "/isdifferentlyabledfile";
            $isdifferentlyabledfile = $request->file('isdifferentlyabledfile');
            $isdifferentlyabledfilename = time().'_'.$user->id.'_'.$isdifferentlyabledfile->getClientOriginalName();
            $destinationPath1 = $commonpath.$subdirectory;
            $isdifferentlyabledfile->move($destinationPath1,$isdifferentlyabledfilename);
            $isdifferentlyabledfilename = $destinationPath1.'/'.$isdifferentlyabledfilename;
        }

        $isservicemanfilename = "NA";
        if($request->file('isservicemanfile')) {
            $subdirectory = "/isserviceman";
            $isservicemanfile = $request->file('isservicemanfile');
            $isservicemanfilename = time().'_'.$user->id.'_'.$isservicemanfile->getClientOriginalName();
            $destinationPath1 = $commonpath.$subdirectory;
            $isservicemanfile->move($destinationPath1,$isservicemanfilename);
            $isservicemanfilename = $destinationPath1.'/'.$isservicemanfilename;
        }

        $iswidowfilename = "NA";
        if($request->file('iswidowfile')) {
            $subdirectory = "/isserviceman";
            $iswidowfile = $request->file('iswidowfile');
            $iswidowfilename = time().'_'.$user->id.'_'.$iswidowfile->getClientOriginalName();
            $destinationPath1 = $commonpath.$subdirectory;
            $iswidowfile->move($destinationPath1,$iswidowfilename);
            $iswidowfilename = $destinationPath1.'/'.$iswidowfilename;
        }

        $divorceefilename = "NA";
        if($request->file('divorceefile')) {
            $subdirectory = "/divorcee";
            $divorceefile = $request->file('divorceefile');
            $divorceefilename = time().'_'.$user->id.'_'.$divorceefile->getClientOriginalName();
            $destinationPath1 = $commonpath.$subdirectory;
            $divorceefile->move($destinationPath1,$divorceefilename);
            $divorceefilename = $destinationPath1.'/'.$divorceefilename;
        }

        $refugeefilename = "NA";
        if($request->file('refugeefile')) {
            $subdirectory = "/refugee";
            $refugeefile = $request->file('refugeefile');
            $refugeefilename = time().'_'.$user->id.'_'.$refugeefile->getClientOriginalName();
            $destinationPath1 = $commonpath.$subdirectory;
            $refugeefile->move($destinationPath1,$refugeefilename);
            $refugeefilename = $destinationPath1.'/'.$refugeefilename;
        }


        $athletefilename = "NA";
        if($request->file('athletefile')) {
            $subdirectory = "/athlete";
            $athletefile = $request->file('athletefile');
            $athletefilename = time().'_'.$user->id.'_'.$athletefile->getClientOriginalName();
            $destinationPath1 = $commonpath.$subdirectory;
            $athletefile->move($destinationPath1,$athletefilename);
            $athletefilename = $destinationPath1.'/'.$athletefilename;
        }

        $tccertificatefilename = "NA";
        if($request->file('tccertificatefile')) {
            $subdirectory = "/tccertificate";
            $tccertificatefile = $request->file('tccertificatefile');
            $tccertificatefilename = time().'_'.$user->id.'_'.$tccertificatefile->getClientOriginalName();
            $destinationPath2 = $commonpath.$subdirectory;
            $tccertificatefile->move($destinationPath2,$tccertificatefilename);
            $tccertificatefilename = $destinationPath2.'/'.$tccertificatefilename;
        }

        $UploadImgfilename = "NA";
        if($request->file('UploadImg')) {
            $subdirectory = "/profile";
            $UploadImg = $request->file('UploadImg');
            $UploadImgfilename = time().'_'.$user->id.'_'.$UploadImg->getClientOriginalName();
            $destinationPath3 = $commonpath.$subdirectory;
            $UploadImg->move($destinationPath3,$UploadImgfilename);
            $UploadImgfilename = $destinationPath3.'/'.$UploadImgfilename;
        }

        $fcsignfilename = "NA";
        if($request->file('fcsign')) {
            $subdirectory = "/fcsign";
            $fcsign = $request->file('fcsign');
            $fcsignfilename = time().'_'.$user->id.'_'.$fcsign->getClientOriginalName();
            $destinationPath4 = $commonpath.$subdirectory;
            $fcsign->move($destinationPath4,$fcsignfilename);
            $fcsignfilename = $destinationPath4.'/'.$fcsignfilename;
        }

        $parentsignfilename = "NA";
        if($request->file('parentsign')) {
            $subdirectory = "/parentsign";
            $parentsign = $request->file('parentsign');
            $parentsignfilename = time().'_'.$user->id.'_'.$parentsign->getClientOriginalName();
            $destinationPath4 = $commonpath.$subdirectory;
            $parentsign->move($destinationPath4,$parentsignfilename);
            $parentsignfilename = $destinationPath4.'/'.$parentsignfilename;
        }

        $slgradefilename = "NA";
        if($request->file('slgrade')) {
            $subdirectory = "/slgrade";
            $slgrade = $request->file('slgrade');
            $slgradefilename = time().'_'.$user->id.'_'.$slgrade->getClientOriginalName();
            $destinationPath4 = $commonpath.$subdirectory;
            $slgrade->move($destinationPath4,$slgradefilename);
            $slgradefilename = $destinationPath4.'/'.$slgradefilename;
        }

        $hsgradefilename = "NA";
        if($request->file('hsgrade')) {
            $subdirectory = "/hsgrade";
            $hsgrade = $request->file('hsgrade');
            $hsgradefilename = time().'_'.$user->id.'_'.$hsgrade->getClientOriginalName();
            $destinationPath4 = $commonpath.$subdirectory;
            $hsgrade->move($destinationPath4,$hsgradefilename);
            $hsgradefilename = $destinationPath4.'/'.$hsgradefilename;
        }

        $uggradefilename = "NA";
        if($request->file('uggrade')) {
            $subdirectory = "/uggrade";
            $uggrade = $request->file('uggrade');
            $uggradefilename = time().'_'.$user->id.'_'.$uggrade->getClientOriginalName();
            $destinationPath4 = $commonpath.$subdirectory;
            $uggrade->move($destinationPath4,$uggradefilename);
            $uggradefilename = $destinationPath4.'/'.$uggradefilename;
        }

        $bggradefilename = "NA";
        if($request->file('bggrade')) {
            $subdirectory = "/bggrade";
            $bggrade = $request->file('bggrade');
            $bggradefilename = time().'_'.$user->id.'_'.$uggrade->getClientOriginalName();
            $destinationPath4 = $commonpath.$subdirectory;
            $bggrade->move($destinationPath4,$bggradefilename);
            $bggradefilename = $destinationPath4.'/'.$bggradefilename;
        }

        $challonfilename = "NA";
        if($request->file('challonfile')) {
            $subdirectory = "/challon";
            $challonfile = $request->file('challonfile');
            $challonfilename = time().'_'.$user->id.'_'.$challonfile->getClientOriginalName();
            $destinationPath4 = $commonpath.$subdirectory;
            $challonfile->move($destinationPath4,$challonfilename);
            $challonfilename = $destinationPath4.'/'.$challonfilename;
        }

        $qrpaymentscreenshotfilename = "NA";
        if($request->file('qrpaymentscreenshotfile')) {
            $subdirectory = "/qrpaymentscreenshot";
            $qrpaymentscreenshotfile = $request->file('qrpaymentscreenshotfile');
            $qrpaymentscreenshotfilename = time().'_'.$user->id.'_'.$qrpaymentscreenshotfile->getClientOriginalName();
            $destinationPath4 = $commonpath.$subdirectory;
            $qrpaymentscreenshotfile->move($destinationPath4,$qrpaymentscreenshotfilename);
            $qrpaymentscreenshotfilename = $destinationPath4.'/'.$qrpaymentscreenshotfilename;
        }

        $student = new StudentParams;
        $student->user_id = $user->id;
        $student->arrn_number = 0;
        $student->fullname = $request->fullname;
        $student->gender = $request->gender;
        $student->dob = date("Y-m-d",strtotime($request->dob));
        $student->age = $request->age;
        $student->mobile1 = $request->mobile1;
        $student->mobile2 = $request->mobile2;
        $student->aadhar = $request->aadhar;
        $student->email = $request->email;
        $student->parent = $request->parent;
        $student->nationality = $request->nationality;
        $student->religion = $request->religion;
        $student->otherreligion = $request->otherreligion;
        $student->plotno = $request->plotno;
        $student->streetname = $request->streetname;
        $student->city = $request->city;
        $student->district = $request->district;
        $student->state = $request->state;
        $student->pincode = $request->pincode;
        $student->pplotno = $request->pplotno;
        $student->pstreetname = $request->pstreetname;
        $student->pcity = $request->pcity;
        $student->pdistrict = $request->pdistrict;
        $student->pstate = $request->pstate;
        $student->ppincode = $request->ppincode;
        $student->community = $request->community;
        $student->subcaste = "";
        $student->Communityfile = $communityfilename;
        $student->isdifferentlyabled = $request->isdifferentlyabled;
        $student->isdifferentlyabledfile = $isdifferentlyabledfilename;
        $student->iswidow = $request->iswidow;
        $student->iswidowfile = $iswidowfilename;
        $student->isserviceman = $request->isserviceman;
        $student->isservicemanfile = $isservicemanfilename;
        $student->divorcee = $request->divorcee;
        $student->divorceefile = $divorceefilename;
        $student->refugee = $request->refugee;
        $student->refugeefile = $refugeefilename;
        $student->athlete = $request->athlete;
        $student->athletefile = $athletefilename;
        $student->tccertificatefile = $tccertificatefilename;
        $student->slmedium = $request->slmedium;
        $student->slYOP = $request->slYOP;
        $student->slnameinst = $request->slnameinst;
        $student->slcertificateno = $request->slcertificateno;
        $student->asltotalmark = $request->asltotalmark;
        $student->aslsecumark = $request->aslsecumark;
        $student->aslpercentage = $request->aslpercentage;
        $student->slgrade = $slgradefilename;
        $student->hsordiploma = $request->hsordiploma;
        $student->hsmedium = $request->hsmedium;
        $student->hsnameinst = $request->hsnameinst;
        $student->hscertificateno = $request->hscertificateno;
        $student->hsYOP = $request->hsYOP;
        $student->ahstotalmark = $request->ahstotalmark;
        $student->ahssecumark = $request->ahssecumark;
        $student->ahspercentage = $request->ahspercentage;
        $student->hsgrade = $hsgradefilename;
        $student->ugmedium = $request->ugmedium;
        $student->ugnameinst = $request->ugnameinst;
        $student->ugcertificateno = $request->ugcertificateno;
        $student->ugYOP = $request->ugYOP;
        $student->ugtotalmark = $request->ugtotalmark;
        $student->ugsecumark = $request->ugsecumark;
        $student->ugpercentage = $request->ugpercentage;
        $student->uggrade = $uggradefilename;
        $student->bgmedium = $request->bgmedium;
        $student->bgnameinst = $request->bgnameinst;
        $student->bgcertificateno = $request->bgcertificateno;
        $student->bgYOP = $request->bgYOP;
        $student->bgtotalmark = $request->bgtotalmark;
        $student->bgsecumark = $request->bgsecumark;
        $student->bgpercentage = $request->bgpercentage;
        $student->bggrade = $bggradefilename;
        $student->icm = $request->icm;
        $student->Amount = $request->Amount;
        $student->challonno = $request->challonno;
        $student->bankname = $request->bankname;
        $student->paymentdistrict = $request->paymentdistrict;
        $student->challonfile = $challonfilename;
        $student->upiid =  $request->upiid;
        $student->transno =  $request->transno;
        $student->qrpaymentscreenshotfile = $qrpaymentscreenshotfilename;
        $student->UploadImg = $UploadImgfilename;
        $student->fcsign = $fcsignfilename;
        $student->parentsign = $parentsignfilename;
        $student->save();

        $gender = "F";

        if($student->gender == "Male"){
            $gender = "M";
        }

        $icmname = Mtr_icm::where('id',$student->icm)->first();

        $icmname =  strtoupper(substr($icmname['icm_name'], 0, 3));
        $arrn_number = $icmname.date("Y").$gender.sprintf("%06d", $student->id);
        $student->arrn_number = $arrn_number;
        $student->update();

        $mobilenumber=$request->mobile1;
        $user->email=$arrn_number;
        $user->update();

       return redirect('application-acknowledgement/'.base64_encode($student->id))->with('status', 'Application submitted successfully');

    }


    function applicationacknowledgement(Request $request){

        date_default_timezone_set("Asia/Kolkata");

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);

        $id = base64_decode($request->id);

        $Studentdetails = StudentParams::where('id',$id)->first();
        $result = (new PHPMailerController)->composeEmail($Studentdetails['id']);

        $arrn_number =  $Studentdetails['arrn_number'];
        $mobilenumber =  $Studentdetails['mobile1'];
        $TEMPLATE_ID = __('smstemplate.application_templateid');
        $SMSAPIKEY = env("SMSAPIKEY");
        $SMSCLIENTID = env("SMSCLIENTID");

//        $downloadlink = env('SELF_URI').'/uploads/applications/'.$arrn_number.'.pdf';
        $hash=md5($arrn_number);
        $hash=substr($hash, 0, 5);
//        $downloadlink = env('SELF_URI').'/uploads/applications/'.$arrn_number.'.pdf';
        $siteURL="https://tncuicm.com/";
        $downloadlink = $siteURL.$hash;
        //message
        $message = __('smstemplate.application_message');
        $message = str_replace("{var1}",$arrn_number,$message);
        $message = str_replace("{var2}",$downloadlink,$message);
        $curl = curl_init();

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
        Log::info($response);

        curl_close($curl);

        $this->applicationpdfonpage($id);

        return view("applicationacknowledgement",compact('Studentdetails'));
    }

    function applicationreview(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);

        $id = base64_decode($request->id);

        $Studentdetails = StudentParams::with('mtr_icm')->where('id',$id)->first();
        //dd($Studentdetails);
        return view("applicationreview",compact('Studentdetails'));
    }

    function applicationpdf(Request $request){

        $id = base64_decode($request->id);
       // $id = $request->id;

        $Studentdetails = StudentParams::where('id',$id)->first()->toArray();

        $this->fpdf->AddPage();
        $this->fpdf->SetFont( 'Helvetica', 'B', 14 );
        $this->fpdf->Cell( 0, 10, 'APPLICATION FORM FOR DIPLOMA IN COOPERATIVE MANAGEMENT ', 0, 1, "C" );
        $this->fpdf->Cell( 0, 10, 'Tamil Nadu Cooperative Union', 0, 1, "C" );

        $this->fpdf->SetFont( 'Arial', 'B', 12 );
        $dAid = 'Application Registration Number: ' . $Studentdetails['arrn_number'];
        $this->fpdf->Cell( 0, 10, $dAid, 0, 1, "R" );
        $this->fpdf->SetLineWidth( 0.5 );
        $this->fpdf->Line( 10, 40, 200, 40 );
        $this->fpdf->Ln();

        $this->fpdf->SetLineWidth( 0.1 );
        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'Course applied for', 1, 0, "L" );
        $this->fpdf->SetFont( 'Arial', '', 9 );
        $this->fpdf->Cell( 70, 5, 'DIPLOMA IN COOPERATIVE MANAGEMENT', 1, 1, "C" );
        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'Advertisement No. and Date', 1, 0, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, '1370/2023 D2 / 13.09.2023', 1, 1, "C" );
        $this->fpdf->Ln();
        $this->fpdf->Image( $Studentdetails['UploadImg'], 160, 55, 28 );

        $regDateTime = $Studentdetails['created_at'];
        $date       = date( "d-m-Y", strtotime($regDateTime) );
        $date1      = date( "h:i:s A" , strtotime($regDateTime));
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'Date of Registration', 1, 0, "L" );

        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, $date, 1, 1, "C" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'Time', 1, 0, "L" );

        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, $date1, 1, 1, "C" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'IP Address', 1, 0, "L" );

        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, $ip_address, 1, 1, "C" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'Name of ICM', 1, 0, "L" );

        $value=Mtr_Icm::where('id', $Studentdetails['icm'])->value('icm_name');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, $value, 1, 1, "C" );

        $this->fpdf->Ln();
        $this->fpdf->Ln();


        $this->fpdf->SetFont( 'Arial', 'B', 12 );
        $this->fpdf->Cell( 40, 5, 'Personal Details', 0, 0, "L" );
        $this->fpdf->Ln();
        $this->fpdf->SetLineWidth( 0.1 );
        $this->fpdf->Line( 10, $this->fpdf->GetY(), 200, $this->fpdf->GetY() );


        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Name', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Gender', 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['fullname'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['gender'], 0, 1, "L" );


        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Date of Birth', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Age', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, date("d-m-Y",strtotime($Studentdetails['dob'])), 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['age'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Mobile number', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Alternate mobile number', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['mobile1'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['mobile2'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Aadhar Number', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Email', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['aadhar'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['email'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Parent / Guardian', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Nationality', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['parent'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['nationality'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Religion', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, '', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['religion'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, "", 0, 1, "L" );

        // $this->fpdf->SetFont( 'Arial', 'B', 10 );
        // $this->fpdf->Cell( 110, 10, 'Religion', 0, 0, "L" );
        // $this->fpdf->Ln();
        // $this->fpdf->SetFont( 'Arial', '', 10 );
        // $this->fpdf->Cell( 110, 5, $Studentdetails['religion'], 0, 0, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Address for Communication', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Permanent Address', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['plotno'].','.$Studentdetails['streetname'].','.$Studentdetails['city'].','.$Studentdetails['district'].','.$Studentdetails['state'].','.$Studentdetails['pincode'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['pplotno'].','.$Studentdetails['pstreetname'].','.$Studentdetails['pcity'].','.$Studentdetails['pdistrict'].','.$Studentdetails['pstate'].','.$Studentdetails['ppincode'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Community', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Differently Abled', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['community'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['isdifferentlyabled'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Destitute Widow', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Ex-Serviceman Category', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['iswidow'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['isserviceman'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Divorcee', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Refugee from Srilanka or Burma', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['divorcee'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['refugee'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Athlete (National/State/District level)', 0, 0, "L" );
        $this->fpdf->Ln();
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 80, 5, $Studentdetails['athlete'], 0, 1, "L" );

        $this->fpdf->AddPage();

        $this->fpdf->Cell( 40, 5, 'Education Details', 0, 0, "L" );
        $this->fpdf->Ln();
        $this->fpdf->SetLineWidth( 0.1 );
        $this->fpdf->Line( 10, $this->fpdf->GetY(), 200, $this->fpdf->GetY() );
        $this->fpdf->Ln();



        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Educational Qualification', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Name &Address of Institution', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, "SSLC", 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['slnameinst'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Medium of Instruction', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Year of passing', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['slmedium'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['slYOP'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Total Marks', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Marks Secured', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['asltotalmark'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['aslsecumark'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Certificate.No', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Percentage', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['slcertificateno'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['aslpercentage'], 0, 1, "L" );
        $this->fpdf->Ln();
        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Educational Qualification', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Name &Address of Institution', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['hsordiploma'] , 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['hsnameinst'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Medium of Instruction', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Year of passing', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['hsmedium'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['hsYOP'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Total Marks', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Marks Secured', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['ahstotalmark'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['ahssecumark'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Certificate.No', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Percentage', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['hscertificateno'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['ahspercentage'], 0, 1, "L" );


        if(!empty($Studentdetails['ugcertificateno']))
        {
            $this->fpdf->Ln();
            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Educational Qualification', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Name &Address of Institution', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, "Degree (3 years)" , 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['ugnameinst'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Medium of Instruction', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Year of passing', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['ugmedium'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['ugYOP'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Total Marks', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Marks Secured', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['ugtotalmark'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['ugsecumark'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Certificate.No', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Percentage', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['ugcertificateno'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['ugpercentage'], 0, 1, "L" );
        }
        if(!empty($Studentdetails['bgcertificateno']))
        {
            $this->fpdf->Ln();
            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Educational Qualification', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Name &Address of Institution', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, "Masters Degree" , 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['bgnameinst'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Medium of Instruction', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Year of passing', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['bgmedium'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['bgYOP'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Total Marks', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Marks Secured', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['bgtotalmark'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['bgsecumark'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Certificate.No', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Percentage', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['bgcertificateno'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['bgpercentage'], 0, 1, "L" );
        }




        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, '', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, '', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 5, "Affirmation", 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, "", 0, 1, "L" );


        $checkboxWidth = 5; // Width of the checkbox
        $checkboxHeight = 5; // Height of the checkbox
        $this->fpdf->SetFont('ZapfDingbats', '', 12); // Use ZapfDingbats font for the checkmark
        $this->fpdf->Cell($checkboxWidth, $checkboxHeight, '4', 0, 0, 'C');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->MultiCell(0, 5, "If I am selected  as  a trainee by your institute of cooperative management, I hereby abide the laws, rules and discipline of the training centre and regularly participate in the classes and examination by maintaining regular attendance and avoiding leaves. Also participate in monthly parents meeting regarding monthly attendance and training. If unable to continue the training due to unavoidable reasons, I agree that I will not demand to refund the tuition fees paid. Also I will attend the classroom examinations without fail. In case of violating legal conditions of the training institute, I agree to be removed from the training without any prior notice.", 0, 'L');
        $checkboxWidth = 5; // Width of the checkbox
        $checkboxHeight = 5; // Height of the checkbox
        $this->fpdf->SetFont('ZapfDingbats', '', 12); // Use ZapfDingbats font for the checkmark
        $this->fpdf->Cell($checkboxWidth, $checkboxHeight, '4', 0, 0, 'C');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->MultiCell(0, 5, "I submit my self-declaration to the principal with evidence that I am not working in any other company and getting salary by signing in attendance register during my training days.", 0, 'L');

        $checkboxWidth = 5; // Width of the checkbox
        $checkboxHeight = 5; // Height of the checkbox
        $this->fpdf->SetFont('ZapfDingbats', '', 12); // Use ZapfDingbats font for the checkmark
        $this->fpdf->Cell($checkboxWidth, $checkboxHeight, '4', 0, 0, 'C');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->MultiCell(0, 5, "I am bound to take any action if it comes to the notice of the principal that if I have submitted wrong information and I give an undertaking that I will not pursue any court of departmental case in this regard", 0, 'L');


        $checkboxWidth = 5; // Width of the checkbox
        $checkboxHeight = 5; // Height of the checkbox
        $this->fpdf->SetFont('ZapfDingbats', '', 12); // Use ZapfDingbats font for the checkmark
        $this->fpdf->Cell($checkboxWidth, $checkboxHeight, '4', 0, 0, 'C');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->MultiCell(0, 5, "I hereby abide the rules and regulations and also legal conditions for the aforesaid declarations", 0, 'L');


        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, '', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, '', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 5, "Parent / Protector Affirmation", 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, "", 0, 1, "L" );

        $checkboxWidth = 5; // Width of the checkbox
        $checkboxHeight = 5; // Height of the checkbox
        $this->fpdf->SetFont('ZapfDingbats', '', 12); // Use ZapfDingbats font for the checkmark
        $this->fpdf->Cell($checkboxWidth, $checkboxHeight, '4', 0, 0, 'C');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->MultiCell(0, 5, " I assure you that the son / daughter in care or who is in my defense thereby agree with the rules and order systems of the Cooperative Management Station. And I accept the whole of the above declarations.", 0, 'L');


        $this->fpdf->SetXY(100, 250); // Adjust the X and Y coordinates as needed
        $this->fpdf->Cell(28, 10, 'Student Signature', 0, 0, 'C');

        // Add heading for parent's signature
        //        $this->fpdf->SetXY(160, 290); // Adjust the X and Y coordinates as needed
        $this->fpdf->Cell(90, 10, 'Parent\Guardian Signature', 0, 0, 'C');
        //        $this->fpdf->AddPage();
        $this->fpdf->Image( $Studentdetails['fcsign'], 100, 260, 28 );
        $this->fpdf->Image( $Studentdetails['parentsign'], 160, 260, 28 );
        $this->fpdf->SetFont( 'Arial', 'B', 12 );
        // Define the file path where you want to save the PDF
        $filePath = 'uploads/applications/'.$Studentdetails["arrn_number"].".pdf"; // Replace with your desired file path and name

        // Output the PDF to the specified file path
        $this->fpdf->Output($filePath, 'F');
        //Set the appropriate headers for file download
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        // Provide the file as a download response
        return response()->download($filePath, $Studentdetails["arrn_number"].".pdf", $headers);
        exit;
    }


    function applicationpdfonpage($id){

       // $id = $request->id;

        $Studentdetails = StudentParams::where('id',$id)->first()->toArray();

        $this->fpdf->AddPage();
        $this->fpdf->SetFont( 'Helvetica', 'B', 14 );
        $this->fpdf->Cell( 0, 10, 'APPLICATION FORM FOR DIPLOMA IN COOPERATIVE MANAGEMENT ', 0, 1, "C" );
        $this->fpdf->Cell( 0, 10, 'Tamil Nadu Cooperative Union', 0, 1, "C" );

        $this->fpdf->SetFont( 'Arial', 'B', 12 );
        $dAid = 'Application Registration Number: ' . $Studentdetails['arrn_number'];
        $this->fpdf->Cell( 0, 10, $dAid, 0, 1, "R" );
        $this->fpdf->SetLineWidth( 0.5 );
        $this->fpdf->Line( 10, 40, 200, 40 );
        $this->fpdf->Ln();

        $this->fpdf->SetLineWidth( 0.1 );
        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'Course applied for', 1, 0, "L" );
        $this->fpdf->SetFont( 'Arial', '', 9 );
        $this->fpdf->Cell( 70, 5, 'DIPLOMA IN COOPERATIVE MANAGEMENT', 1, 1, "C" );
        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'Advertisement No. and Date', 1, 0, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, '1370/2023 D2 / 13.09.2023', 1, 1, "C" );
        $this->fpdf->Ln();
        $this->fpdf->Image( $Studentdetails['UploadImg'], 160, 55, 28 );

        $regDateTime = $Studentdetails['created_at'];
        $date       = date( "d-m-Y", strtotime($regDateTime) );
        $date1      = date( "h:i:s A" , strtotime($regDateTime));
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'Date of Registration', 1, 0, "L" );

        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, $date, 1, 1, "C" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'Time', 1, 0, "L" );

        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, $date1, 1, 1, "C" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'IP Address', 1, 0, "L" );

        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, $ip_address, 1, 1, "C" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'Name of ICM', 1, 0, "L" );

        $value=Mtr_Icm::where('id', $Studentdetails['icm'])->value('icm_name');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, $value, 1, 1, "C" );

        $this->fpdf->Ln();
        $this->fpdf->Ln();


        $this->fpdf->SetFont( 'Arial', 'B', 12 );
        $this->fpdf->Cell( 40, 5, 'Personal Details', 0, 0, "L" );
        $this->fpdf->Ln();
        $this->fpdf->SetLineWidth( 0.1 );
        $this->fpdf->Line( 10, $this->fpdf->GetY(), 200, $this->fpdf->GetY() );


        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Name', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Gender', 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['fullname'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['gender'], 0, 1, "L" );


        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Date of Birth', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Age', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, date("d-m-Y",strtotime($Studentdetails['dob'])), 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['age'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Mobile number', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Alternate mobile number', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['mobile1'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['mobile2'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Aadhar Number', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Email', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['aadhar'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['email'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Parent / Guardian', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Nationality', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['parent'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['nationality'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Religion', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, '', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['religion'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, "", 0, 1, "L" );

        // $this->fpdf->SetFont( 'Arial', 'B', 10 );
        // $this->fpdf->Cell( 110, 10, 'Religion', 0, 0, "L" );
        // $this->fpdf->Ln();
        // $this->fpdf->SetFont( 'Arial', '', 10 );
        // $this->fpdf->Cell( 110, 5, $Studentdetails['religion'], 0, 0, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Address for Communication', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Permanent Address', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['plotno'].','.$Studentdetails['streetname'].','.$Studentdetails['city'].','.$Studentdetails['district'].','.$Studentdetails['state'].','.$Studentdetails['pincode'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['pplotno'].','.$Studentdetails['pstreetname'].','.$Studentdetails['pcity'].','.$Studentdetails['pdistrict'].','.$Studentdetails['pstate'].','.$Studentdetails['ppincode'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Community', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Differently Abled', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['community'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['isdifferentlyabled'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Destitute Widow', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Ex-Serviceman Category', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['iswidow'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['isserviceman'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Divorcee', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Refugee from Srilanka or Burma', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['divorcee'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['refugee'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Athlete (National/State/District level)', 0, 0, "L" );
        $this->fpdf->Ln();
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 80, 5, $Studentdetails['athlete'], 0, 1, "L" );

        $this->fpdf->AddPage();

        $this->fpdf->Cell( 40, 5, 'Education Details', 0, 0, "L" );
        $this->fpdf->Ln();
        $this->fpdf->SetLineWidth( 0.1 );
        $this->fpdf->Line( 10, $this->fpdf->GetY(), 200, $this->fpdf->GetY() );
        $this->fpdf->Ln();



        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Educational Qualification', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Name &Address of Institution', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, "SSLC", 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['slnameinst'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Medium of Instruction', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Year of passing', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['slmedium'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['slYOP'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Total Marks', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Marks Secured', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['asltotalmark'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['aslsecumark'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Certificate.No', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Percentage', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['slcertificateno'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['aslpercentage'], 0, 1, "L" );
        $this->fpdf->Ln();
        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Educational Qualification', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Name &Address of Institution', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['hsordiploma'] , 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['hsnameinst'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Medium of Instruction', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Year of passing', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['hsmedium'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['hsYOP'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Total Marks', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Marks Secured', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['ahstotalmark'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['ahssecumark'], 0, 1, "L" );

        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, 'Certificate.No', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, 'Percentage', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['hscertificateno'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['ahspercentage'], 0, 1, "L" );


        if(!empty($Studentdetails['ugcertificateno']))
        {
            $this->fpdf->Ln();
            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Educational Qualification', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Name &Address of Institution', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, "Degree (3 years)" , 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['ugnameinst'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Medium of Instruction', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Year of passing', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['ugmedium'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['ugYOP'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Total Marks', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Marks Secured', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['ugtotalmark'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['ugsecumark'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Certificate.No', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Percentage', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['ugcertificateno'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['ugpercentage'], 0, 1, "L" );
        }
        if(!empty($Studentdetails['bgcertificateno']))
        {
            $this->fpdf->Ln();
            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Educational Qualification', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Name &Address of Institution', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, "Masters Degree" , 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['bgnameinst'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Medium of Instruction', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Year of passing', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['bgmedium'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['bgYOP'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Total Marks', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Marks Secured', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['bgtotalmark'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['bgsecumark'], 0, 1, "L" );

            $this->fpdf->SetFont( 'Arial', 'B', 10 );
            $this->fpdf->Cell( 110, 10, 'Certificate.No', 0, 0, "L" );
            $this->fpdf->Cell( 80, 10, 'Percentage', 0, 1, "L" );
            $this->fpdf->SetFont( 'Arial', '', 10 );
            $this->fpdf->Cell( 110, 5, $Studentdetails['bgcertificateno'], 0, 0, "L" );
            $this->fpdf->Cell( 80, 5, $Studentdetails['bgpercentage'], 0, 1, "L" );
        }




        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, '', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, '', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 5, "Affirmation", 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, "", 0, 1, "L" );


        $checkboxWidth = 5; // Width of the checkbox
        $checkboxHeight = 5; // Height of the checkbox
        $this->fpdf->SetFont('ZapfDingbats', '', 12); // Use ZapfDingbats font for the checkmark
        $this->fpdf->Cell($checkboxWidth, $checkboxHeight, '4', 0, 0, 'C');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->MultiCell(0, 5, "If I am selected  as  a trainee by your institute of cooperative management, I hereby abide the laws, rules and discipline of the training centre and regularly participate in the classes and examination by maintaining regular attendance and avoiding leaves. Also participate in monthly parents meeting regarding monthly attendance and training. If unable to continue the training due to unavoidable reasons, I agree that I will not demand to refund the tuition fees paid. Also I will attend the classroom examinations without fail. In case of violating legal conditions of the training institute, I agree to be removed from the training without any prior notice.", 0, 'L');
        $checkboxWidth = 5; // Width of the checkbox
        $checkboxHeight = 5; // Height of the checkbox
        $this->fpdf->SetFont('ZapfDingbats', '', 12); // Use ZapfDingbats font for the checkmark
        $this->fpdf->Cell($checkboxWidth, $checkboxHeight, '4', 0, 0, 'C');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->MultiCell(0, 5, "I submit my self-declaration to the principal with evidence that I am not working in any other company and getting salary by signing in attendance register during my training days.", 0, 'L');

        $checkboxWidth = 5; // Width of the checkbox
        $checkboxHeight = 5; // Height of the checkbox
        $this->fpdf->SetFont('ZapfDingbats', '', 12); // Use ZapfDingbats font for the checkmark
        $this->fpdf->Cell($checkboxWidth, $checkboxHeight, '4', 0, 0, 'C');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->MultiCell(0, 5, "I am bound to take any action if it comes to the notice of the principal that if I have submitted wrong information and I give an undertaking that I will not pursue any court of departmental case in this regard", 0, 'L');


        $checkboxWidth = 5; // Width of the checkbox
        $checkboxHeight = 5; // Height of the checkbox
        $this->fpdf->SetFont('ZapfDingbats', '', 12); // Use ZapfDingbats font for the checkmark
        $this->fpdf->Cell($checkboxWidth, $checkboxHeight, '4', 0, 0, 'C');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->MultiCell(0, 5, "I hereby abide the rules and regulations and also legal conditions for the aforesaid declarations", 0, 'L');


        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 10, '', 0, 0, "L" );
        $this->fpdf->Cell( 80, 10, '', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 110, 5, "Parent / Protector Affirmation", 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, "", 0, 1, "L" );

        $checkboxWidth = 5; // Width of the checkbox
        $checkboxHeight = 5; // Height of the checkbox
        $this->fpdf->SetFont('ZapfDingbats', '', 12); // Use ZapfDingbats font for the checkmark
        $this->fpdf->Cell($checkboxWidth, $checkboxHeight, '4', 0, 0, 'C');
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->MultiCell(0, 5, " I assure you that the son / daughter in care or who is in my defense thereby agree with the rules and order systems of the Cooperative Management Station. And I accept the whole of the above declarations.", 0, 'L');


        $this->fpdf->SetXY(100, 250); // Adjust the X and Y coordinates as needed
        $this->fpdf->Cell(28, 10, 'Student Signature', 0, 0, 'C');

        // Add heading for parent's signature
        //        $this->fpdf->SetXY(160, 290); // Adjust the X and Y coordinates as needed
        $this->fpdf->Cell(90, 10, 'Parent\Guardian Signature', 0, 0, 'C');
        //        $this->fpdf->AddPage();
        $this->fpdf->Image( $Studentdetails['fcsign'], 100, 260, 28 );
        $this->fpdf->Image( $Studentdetails['parentsign'], 160, 260, 28 );
        $this->fpdf->SetFont( 'Arial', 'B', 12 );
        // Define the file path where you want to save the PDF
        $filePath = 'uploads/applications/'.$Studentdetails["arrn_number"].".pdf"; // Replace with your desired file path and name

        // Output the PDF to the specified file path
        $this->fpdf->Output($filePath, 'F');
        //Set the appropriate headers for file download
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        // Provide the file as a download response
        return response()->download($filePath, $Studentdetails["arrn_number"].".pdf", $headers);
        exit;
    }

    function checkicmeligible(Request $request){

      //  dd($request);
        $icmid = $request->icm;
        $email = $request->email;
        $aadhar = $request->aadhar;
        $mobile1 = $request->mobile1;

        $studentemail = StudentParams::where('icm', $icmid)->where('email',$email)->count();
        $studentaadhar = StudentParams::where('icm', $icmid)->where('aadhar',$aadhar)->count();
        $studentmobile1 = StudentParams::where('icm', $icmid)->where('mobile1',$mobile1)->count();

        $studenmsg = "";

        if($studentemail > 0){
            $studenmsg = "Email";
        }

        if($studentaadhar > 0){

            if($studenmsg == ""){
                $studenmsg = "Adhaar";
            }else{
                $studenmsg = $studenmsg.", Adhaar";
            }

        }

        if($studentmobile1 > 0){

            if($studenmsg == ""){
                $studenmsg = "Mobile no";
            }else{
                $studenmsg = $studenmsg.", Mobile no";
            }

        }


        if(!empty($studenmsg)){
            $studenmsg = $studenmsg." already exist for this ICM";
        }

        return response()->json(['status' => 200, 'message' => $studenmsg, 'studentemail' => $studentemail, 'studentaadhar' => $studentaadhar, 'studentmobile1' => $studentmobile1]);

    }


    public function sendsms($mobilenumber,$arrn_number){



    }

}
