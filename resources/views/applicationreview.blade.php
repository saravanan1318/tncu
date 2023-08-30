@extends('layouts.applicationpdf')

@section('content')
<div class="col-sm-12 col-md-11 mx-auto p-3 body-cards bg-white">
    <div class="row">
        <div class="col-sm-1 col-md-1 mb-4">
        </div>
       <div class="col-sm-12 col-md-10 mb-4" id="printdiv">
            <fieldset>
                <h4 style="text-align: center;padding:10px;">APPLICATION FORM FOR THE {{ __('form.heading') }} <br> Tamil Nadu Cooperative Union</h4>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                          
                        </div>
                        <div class="col-md-6" style="text-align: right;  font-weight: 600;">
                            <p>Application Registration Number : {{$Studentdetails->arrn_number}}</p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                          <table class="table table-bordered">
                            <tr>
                                <td>Appication Applied for</td>
                                <td>Advertisement No and Date</td>
                            </tr>
                            <tr>
                                <td>DIPLOMA IN COOPERATIVE MANAGEMENT</td>
                                <td>1050/PE3/2017(1-6) 20.06.2018</td>
                            </tr>
                          </table>
                        </div>
                        <div class="col-md-6" style="text-align: right;  font-weight: 600;">
                            <img id="cimage" src="{{asset($Studentdetails->UploadImg)}}" alt="your image" style="margin-top: 10px;width:150px ">
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 subHeadings">
                            <b>{{__('form.personal')}}</b>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="editor-label">
                                Name <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>{{$Studentdetails->fullname}}<h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="editor-label">
                                Gender <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>{{$Studentdetails->gender}}<h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="editor-label">
                                Date of Birth (dd-MM-yyyy)<span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepickerDOB" >
                                            <h6>{{$Studentdetails->dob}}<h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="editor-label">
                                Age (in completed years)<span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>{{$Studentdetails->age}}<h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="editor-label">
                                Mobile number <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>{{$Studentdetails->mobile1}}<h6>
    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="editor-label">
                                Alternate mobile number
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>{{$Studentdetails->mobile2}}<h6>
                                </div>
                            </div>
    
                        </div>
                        <div class="col-md-4">
                            <div class="editor-label">
                                Aadhar Number <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>{{$Studentdetails->aadhar}}<h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="editor-label">
                                Email <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>{{$Studentdetails->email}}<h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="editor-label">
                                Parent / Guardian <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>{{$Studentdetails->parent}}<h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="editor-label">
                                Parent / Guardian <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>{{$Studentdetails->religion}}<h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 subHeadings">
                            <b>Address for Communication</b>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6">
                            <div class="editor-label">
                                Door/ Flat/Plot No <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Door / Flat / Plot field is required." id="plotno" maxlength="50" name="plotno" placeholder="Door/ Flat/Plot No" type="text" value="{{$Studentdetails->plotno}}" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Street/ Road Name <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Street / Road field is required." id="streetname" maxlength="50" name="streetname" placeholder="Street/ Road Name" type="text" value="{{$Studentdetails->streetname}}" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Town/ City <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="City field is required." id="city" maxlength="50" name="city" placeholder="Town/ City" type="text" value="{{$Studentdetails->city}}" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                District <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The District field is required." id="district" maxlength="50" name="district" placeholder="District" type="text" value="{{$Studentdetails->district}}" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                State <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The State field is required." id="state" maxlength="50" name="state" placeholder="State" type="text" value="{{$Studentdetails->state}}" oninput="this.value=this.value.replace(/[^A-Za-z]/g,'');" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Pincode <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true"  maxlength="6" data-val-required="The Pincode field is required." id="pincode" maxlength="50" name="pincode" placeholder="Pincode" type="text" value="{{$Studentdetails->pincode}}" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 subHeadings">
                            <b>Permanent Address</b>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6">
                            <div class="editor-label">
                                Door/ Flat/Plot No <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Door / Flat / Plot field is required." id="pplotno" maxlength="50" name="pplotno" placeholder="Door/ Flat/Plot No" type="text" value="{{$Studentdetails->pplotno}}" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Street/ Road Name <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Street / Road field is required." id="pstreetname" maxlength="50" name="pstreetname" placeholder="Street/ Road Name" type="text" value="{{$Studentdetails->pstreetname}}" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Town/ City <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="City field is required." id="pcity" maxlength="50" name="pcity" placeholder="Avenue /Block /Sector" type="text" value="{{$Studentdetails->pcity}}" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                District <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The District field is required." id="pdistrict" maxlength="50" name="pdistrict" placeholder="District" type="text" value="{{$Studentdetails->pdistrict}}" oninput="this.value=this.value.replace(/[^A-Za-z]/g,'');" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                State <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The State field is required." id="pstate" maxlength="50" name="pstate" placeholder="State" type="text" value="{{$Studentdetails->pstate}}" oninput="this.value=this.value.replace(/[^A-Za-z]/g,'');" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Pincode <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true"  maxlength="6" data-val-required="The Pincode field is required." id="ppincode" maxlength="50" name="ppincode" placeholder="Pincode" type="text" value="{{$Studentdetails->ppincode}}" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6">
                            <div class="editor-label">
                                Community <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The Community field is required." id="community" name="community"  type="text" value="{{$Studentdetails->community}}" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row"  style="margin-top: 10px">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        Do you belong to Differently Abled Category <span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input autocomplete="off" id="IsDifferentlyAbled" data-val="true" data-val-required="Differently Abled Category field is required." name="isdifferentlyabled" type="text" value="{{$Studentdetails->isdifferentlyabled}}" required="" >

                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row"  style="margin-top: 10px" style="display: none;" id="typeof">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        Type of Disability
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <input autocomplete="off" id="typeofd" name="typeofd" type="text" value="{{$Studentdetails->typeofd}}" required="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        Do you belong to Destitute Widow Category <span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input autocomplete="off" id="iswidow" name="iswidow" type="text" value="{{$Studentdetails->iswidow}}" required="" >

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        Do you belong to Ex-Serviceman Category <span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input autocomplete="off" id="isserviceman" name="isserviceman" type="text" value="{{$Studentdetails->isserviceman}}" required="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        Divorcee
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input autocomplete="off" id="divorcee" name="divorcee" type="text" value="{{$Studentdetails->divorcee}}" required="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        Refugee from Srilanka or Burma
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input autocomplete="off" id="refugee" name="refugee" type="text" value="{{$Studentdetails->refugee}}" required="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        Athlete (National/State/District level): <span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input autocomplete="off" id="athlete" name="athlete" type="text" value="{{$Studentdetails->athlete}}" required="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-sm-12 subHeadings">
                            <b>Educational Qualification</b>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-12" >
                            <table class="table table-responsive" style=" border:1px solid #b0b0b0; padding:3px; margin-left:5px;">
                                <tbody><tr style="    background-color: #3c842b;
                                    color: white;
                                    text-align: center;
                                    font-weight: bold;">
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Educational
                                                                                        Qualification
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Medium of Instruction</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Name of the Institution</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Year of Passing</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Total Marks</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Marks Secured</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"> Percentage</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Grade/Class</td>
                                </tr>
        
                                <tr>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">S.S.L.C
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <input autocomplete="off" id="slmedium" name="slmedium" type="text" value="{{$Studentdetails->slmedium}}" required="" >
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" name="slnameinst"  value="{{$Studentdetails->slnameinst}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="slYOP" min="1980" max="2018"  value="{{$Studentdetails->slYOP}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="asltotalmark"  value="{{$Studentdetails->asltotalmark}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="aslsecumark"  value="{{$Studentdetails->aslsecumark}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="aslpercentage"  value="{{$Studentdetails->aslpercentage}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:70px; border:solid 1px #ffffff;" name="slgrade"  value="{{$Studentdetails->slgrade}}" ></td>
                                </tr>
        
                                <tr>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">HSC (+2)
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <input autocomplete="off" id="hsmedium" name="hsmedium" type="text" value="{{$Studentdetails->hsmedium}}" required="">
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" name="hsnameinst"  value="{{$Studentdetails->hsnameinst}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="hsYOP" min="1980" max="2018"  value="{{$Studentdetails->hsYOP}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ahstotalmark"  value="{{$Studentdetails->ahstotalmark}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ahssecumark"  value="{{$Studentdetails->ahssecumark}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ahspercentage"  value="{{$Studentdetails->ahspercentage}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:70px; border:solid 1px #ffffff;" name="hsgrade"  value="{{$Studentdetails->hsgrade}}" ></td>
                                </tr>
                                <tr>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Degree (3Years)
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <input autocomplete="off" id="ugmedium" name="ugmedium" type="text" value="{{$Studentdetails->ugmedium}}" required="">
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" name="ugnameinst"  value="{{$Studentdetails->ugnameinst}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ugYOP" min="1980" max="2018"  value="{{$Studentdetails->ugYOP}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ugtotalmark"  value="{{$Studentdetails->ugtotalmark}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ugsecumark"  value="{{$Studentdetails->ugsecumark}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ugpercentage"  value="{{$Studentdetails->ugpercentage}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:70px; border:solid 1px #ffffff;" name="uggrade"  value="{{$Studentdetails->uggrade}}" ></td>
                                </tr>
                                <tr>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Post Gradguate Degree
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <input autocomplete="off" id="bgmedium" name="bgmedium" type="text" value="{{$Studentdetails->bgmedium}}" required="">
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" name="bgnameinst"  value="{{$Studentdetails->bgnameinst}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="bgYOP" min="1980" max="2018"  value="{{$Studentdetails->bgYOP}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="bgtotalmark"  value="{{$Studentdetails->bgtotalmark}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="bgsecumark"  value="{{$Studentdetails->bgsecumark}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="bgpercentage"  value="{{$Studentdetails->bgpercentage}}" ></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:70px; border:solid 1px #ffffff;" name="bggrade"  value="{{$Studentdetails->bggrade}}" ></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="editor-label">
                                        Choose ICM<span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <input autocomplete="off" id="icm" name="icm" type="text" value="{{$Studentdetails->icm}}" required="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-12 subHeadings">
                            <b>Declaration</b>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;text-align:justify">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                        In the state of advanced language training, selected trainers undergo training sessions, adhere to the rules and regulations, and follow the guidelines for examinations and assessment procedures. I am aware of the procedures for registration and application for the examination and certification related to training. I attend the training and participate in the parent association's meetings without any issues, except for reasons beyond my control. I will report and return the training fees collected by the parent association, excluding Kama, and I will strictly adhere to the rules and regulations in Kama's examination department. I voluntarily accept the consequences of not adhering to the regulations of the training state and understand the consequences of non-compliance.
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                        I have submitted my application for employment in various organizations during the days I receive training, but I have not received any response to obtain a job due to the lack of experience. I hereby submit my sincere self-declaration to the authorities for consideration.

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                        I have submitted the incorrect information, and I am aware that any action can be taken against me according to the laws and regulations, and I am willing to face legal actions through the court or any department related to this matter. I affirm the truthfulness of this statement.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-12 subHeadings">
                            <b>Payment Details</b>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <input class="form-control" id="Amount" name="Amount" type="text" value="Rs.100" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-12 subHeadings">
                            <b>Upload Documents</b>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="editor-label">Photo</div>
                                    </div>
                                    <div class="col-sm-12">
                                        <img id="cimage" src="{{asset($Studentdetails->UploadImg)}}" alt="your image" style="margin-top: 10px;width:150px ">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="editor-label">
                                        Signature
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <img id="csign" src="{{asset($Studentdetails->fcsign)}}" alt="your image" style="margin-top: 30px;width:130px ">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="editor-label">
                                        Signature
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <img id="parentsign" src="{{asset($Studentdetails->parentsign)}}" alt="your image" style="margin-top: 30px;width:130px ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <p style="text-align: center;">
                                <!--<button type="button" id="btnPreview" class="btnStyle">Preview</button> -->
                                <button  class="btnStyle btn btn-primary" onclick="printDiv()">Download Application</button>
                                <!--                <input type="button" name="btnPayment" id="btnPayment" value="Make Payment" class="btnStyle">-->
                            </p>
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                   
                </fieldset>
       </div>
       <div class="col-sm-1 col-md-1 mb-4"></div>
    </div>
 </div>

@endsection