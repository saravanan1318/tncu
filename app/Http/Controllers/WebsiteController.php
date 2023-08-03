<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentParams;

class WebsiteController extends Controller
{
    //

    function index(){
        return view("home");
    }

    function applicationform(){
        return view("applicationform");
    }

    function store(Request $request){

        $user = new User;
        $user->name = $request->fullname;
        $user->phone = $request->mobile1;
        $user->state = $request->state;
        $user->email = $request->email;
        $user->password = $request->mobile1;
        $user->role = 3;
        $user->save();


        $communityfilename = "NA";
        if($request->file()) {
            $fileName = time().'_'.$request->file('Communityfile')->getClientOriginalName();
            $filePath = $request->file('Communityfile')->storeAs('uploads', $fileName, 'public');
            $communityfilename = '/storage/' . $filePath .$fileName;
        }

        $tccertificatefile = "NA";
        if($request->file()) {
            $fileName = time().'_'.$request->file('tccertificatefile')->getClientOriginalName();
            $filePath = $request->file('tccertificatefile')->storeAs('uploads', $fileName, 'public');
            $tccertificatefile = '/storage/' . $filePath .$fileName;
        }

        $UploadImgfile = "NA";
        if($request->file()) {
            $fileName = time().'_'.$request->file('UploadImg')->getClientOriginalName();
            $filePath = $request->file('UploadImg')->storeAs('uploads', $fileName, 'public');
            $UploadImgfile = '/storage/' . $filePath .$fileName;
        }

        $fcsignfile = "NA";
        if($request->file()) {
            $fileName = time().'_'.$request->file('fcsign')->getClientOriginalName();
            $filePath = $request->file('fcsign')->storeAs('uploads', $fileName, 'public');
            $fcsignfile = '/storage/' . $filePath .$fileName;
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
        $student->tccertificatefile = $request->tccertificatefile;
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
        $student->UploadImg = $request->UploadImg;
        $student->fcsign = $request->fcsign;
        $student->save();

        return redirect('applicationform')->with('status', 'Application submitted successfully');

    }
}
