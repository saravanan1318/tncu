<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentParams;
use App\Models\Mtr_Icm;
use App;
use Hash;
use PDF; 
use Illuminate\Support\Facades\Storage;
use Codedge\Fpdf\Fpdf\Fpdf;

class WebsiteController extends Controller
{
    //

    protected $fpdf;
 
    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }
    
    function index(){
        return view("home");
    }

    function notification(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);  
        return view("notification");
    }

    function applicationform(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);  

        $icmlists = Mtr_Icm::all();
        return view("applicationform",compact('icmlists'));
    }

    function store(Request $request){

        $user = new User;
        $user->name = $request->fullname;
        $user->phone = $request->mobile1;
        $user->state = $request->state;
        $user->email = $request->email;
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

        $student = new StudentParams;
        $student->user_id = $user->id;
        $student->arrn_number = 0;
        $student->fullname = $request->fullname;
        $student->gender = $request->gender;
        $student->dob = $request->dob;
        $student->age = $request->age;
        $student->mobile1 = $request->mobile1;
        $student->mobile2 = $request->mobile2;
        $student->aadhar = $request->aadhar;
        $student->email = $request->email;
        $student->parent = $request->parent;
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
        $student->asltotalmark = $request->asltotalmark;
        $student->aslsecumark = $request->aslsecumark;
        $student->aslpercentage = $request->aslpercentage;
        $student->slgrade = $slgradefilename;
        $student->hsordiploma = $request->hsordiploma;
        $student->hsmedium = $request->hsmedium;
        $student->hsnameinst = $request->hsnameinst;
        $student->hsYOP = $request->hsYOP;
        $student->ahstotalmark = $request->ahstotalmark;
        $student->ahssecumark = $request->ahssecumark;
        $student->ahspercentage = $request->ahspercentage;
        $student->hsgrade = $hsgradefilename;
        $student->ugmedium = $request->ugmedium;
        $student->ugnameinst = $request->ugnameinst;
        $student->ugYOP = $request->ugYOP;
        $student->ugtotalmark = $request->ugtotalmark;
        $student->ugsecumark = $request->ugsecumark;
        $student->ugpercentage = $request->ugpercentage;
        $student->uggrade = $uggradefilename;
        $student->bgmedium = $request->bgmedium;
        $student->bgnameinst = $request->bgnameinst;
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

        return redirect('application-acknowledgement/'.$student->id)->with('status', 'Application submitted successfully');

    }


    function applicationacknowledgement(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);  

        $Studentdetails = StudentParams::where('id',$request->id)->first();
        $result = (new PHPMailerController)->composeEmail($Studentdetails['id']);

        return view("applicationacknowledgement",compact('Studentdetails'));
    }

    function applicationreview(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);  

        $Studentdetails = StudentParams::with('mtr_icm')->where('id',$request->id)->first();
        //dd($Studentdetails);
        return view("applicationreview",compact('Studentdetails'));
    }

    function applicationpdfold(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);  

        $Studentdetails = StudentParams::where('id',$request->id)->first()->toArray();

        $pdf = PDF::loadView('applicationpdf', compact('Studentdetails'));

        return $pdf->download('sample.pdf');
        //dd($Studentdetails);
       // return view("applicationpdf",compact('Studentdetails'));
        // $pdf = PDF::loadView('applicationpdf', $Studentdetails);
        // return $pdf->stream('resume.pdf');

    }
    function applicationpdfold2(Request $request){

        $Studentdetails = StudentParams::where('id',$request->id)->first()->toArray();

        //return view("applicationpdf",compact('Studentdetails'));

        $pdf = PDF::loadView('applicationpdf', compact('Studentdetails'));

        return $pdf->download('sample.pdf');

    }

    function applicationpdf(Request $request){

        $Studentdetails = StudentParams::where('id',$request->id)->first()->toArray();

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
        $this->fpdf->Cell( 50, 5, 'Post applied for', 1, 0, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, 'DIPLOMA IN COOPERATIVE MANAGEMENT', 1, 1, "C" );
        $this->fpdf->SetFont( 'Arial', 'B', 10 );
        $this->fpdf->Cell( 50, 5, 'Advertisement No. and Date', 1, 0, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 70, 5, '1050/PE3/2017(1-6)   20.06.2018', 1, 1, "C" );
        $this->fpdf->Ln();
        $this->fpdf->Image( $Studentdetails['UploadImg'], 160, 43, 28 );
        
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
        $this->fpdf->Cell( 80, 10, 'Religion', 0, 1, "L" );
        $this->fpdf->SetFont( 'Arial', '', 10 );
        $this->fpdf->Cell( 110, 5, $Studentdetails['parent'], 0, 0, "L" );
        $this->fpdf->Cell( 80, 5, $Studentdetails['religion'], 0, 1, "L" );
        
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
        $this->fpdf->Cell( 110, 5, $Studentdetails['religion'], 0, 0, "L" );
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
        $this->fpdf->Cell( 80, 5, $Studentdetails['athlete'], 0, 1, "L" );

        $this->fpdf->AddPage();

        $this->fpdf->Image( $Studentdetails['fcsign'], 100, 43, 28 );
        $this->fpdf->Image( $Studentdetails['parentsign'], 160, 43, 28 );

        $this->fpdf->Output();
        exit;
    }

}
