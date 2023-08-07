<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentParams;
use App\Models\Mtr_Icm;
use PDF;
use App;
use Hash;

class WebsiteController extends Controller
{
    //

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

        $student = new StudentParams;
        $student->user_id = $user->id;
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
        $student->subcaste = $request->subcaste;
        $student->Communityfile = $communityfilename;
        $student->isdifferentlyabled = $request->isdifferentlyabled;
        $student->typeofd = $request->typeofd;
        $student->iswidow = $request->iswidow;
        $student->isserviceman = $request->isserviceman;
        $student->divorcee = $request->divorcee;
        $student->refugee = $request->refugee;
        $student->athlete = $request->athlete;
        $student->tccertificatefile = $tccertificatefilename;
        $student->slmedium = $request->slmedium;
        $student->slYOP = $request->slYOP;
        $student->slnameinst = $request->slnameinst;
        $student->asltotalmark = $request->asltotalmark;
        $student->aslsecumark = $request->aslsecumark;
        $student->aslpercentage = $request->aslpercentage;
        $student->slgrade = $request->slgrade;
        $student->hsmedium = $request->hsmedium;
        $student->hsnameinst = $request->hsnameinst;
        $student->hsYOP = $request->hsYOP;
        $student->ahstotalmark = $request->ahstotalmark;
        $student->ahssecumark = $request->ahssecumark;
        $student->ahspercentage = $request->ahspercentage;
        $student->hsgrade = $request->hsgrade;
        $student->ugmedium = $request->ugmedium;
        $student->ugnameinst = $request->ugnameinst;
        $student->ugYOP = $request->ugYOP;
        $student->ugtotalmark = $request->ugtotalmark;
        $student->ugsecumark = $request->ugsecumark;
        $student->ugpercentage = $request->ugpercentage;
        $student->uggrade = $request->uggrade;
        $student->bgmedium = $request->bgmedium;
        $student->bgnameinst = $request->bgnameinst;
        $student->bgYOP = $request->bgYOP;
        $student->bgtotalmark = $request->bgtotalmark;
        $student->bgsecumark = $request->bgsecumark;
        $student->bgpercentage = $request->bgpercentage;
        $student->bggrade = $request->bggrade;
        $student->icm = $request->icm;
        $student->Amount = $request->Amount;
        $student->UploadImg = $UploadImgfilename;
        $student->fcsign = $fcsignfilename;
        $student->save();

        return redirect('applicationreview/'.$student->id)->with('status', 'Application submitted successfully');

    }


    function applicationreview(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);  

        $Studentdetails = StudentParams::where('id',$request->id)->first();
        return view("applicationreview",compact('Studentdetails'));
    }

    function applicationpdf(Request $request){

        App::setLocale($request->lang);
        session()->put('locale', $request->lang);  

        $data = StudentParams::where('id',$request->id)->first()->toArray();

        //dd($Studentdetails);

        $pdf = PDF::loadView('applicationpdf', $data);
        return $pdf->stream('resume.pdf');

    }
}
