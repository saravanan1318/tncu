@extends('layouts.master')

@section('content')
<div class="col-sm-12 col-md-11 mx-auto p-3 body-cards bg-white">
    <div class="row">
        <div class="col-sm-12 col-md-12 mb-4">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1 col-md-1 mb-4">
        </div>
       <div class="col-sm-10 col-md-10 mb-4">
        <form action="{{url('store-applicationform')}}" id="regform" enctype="multipart/form-data" method="post" novalidate="novalidate">
            @csrf
            <fieldset>
                <legend style="text-align: center;padding:10px;background-color:#194565;color:#fff">{{ __('form.heading') }}</legend>
    
                <div class="container-fluid">
    
                    <div class="row">
                        <div class="col-sm-12 subHeadings">
                            <b>{{__('form.personal')}}</b>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="editor-label">
                                Name <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The Name field is required." id="Name" maxlength="50" name="fullname" placeholder="Candidate name" type="text" value="" style="text-transform: uppercase;" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Gender <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control" data-val="true" data-val-required="The Gender field is required." id="Gender" name="gender" required="">
                                        <option value="">- Choose -</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Date of Birth (dd-MM-yyyy)<span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepickerDOB" readonly="readonly">
                                            <input class="form-control" data-val="true" data-val-required="The DOB field is required." id="DOB" name="dob" onkeydown="return false" type="date" value="" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Age (in completed years)<span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The age field is required." id="Age"  name="age" placeholder="Age" type="text" readonly="" value="" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Mobile number <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The Mobilenumber field is required." id="Mobile1" maxlength="10" minlength="10" name="mobile1" placeholder="Mobile" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" min="10" value="" onkeyup="validateLength(this)" required="">
    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Alternate mobile number
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" id="Mobile2" maxlength="10" name="mobile2" placeholder="Alternate mobile number" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="">
                                </div>
                            </div>
    
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Aadhar Number <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" id="AadharNumber" maxlength="12" data-val="true" data-val-required="The AadharNumber field is required." name="aadhar" placeholder=" Aadhar Number" type="text" onkeypress="return check(event,value)" oninput="this.value=this.value.replace(/[^0-9]/g,''); checkLength(12,this)" value="" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Email <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" id="Email" data-val="true" data-val-required="The Email field is required." name="email" placeholder=" Email Id" type="text" value="" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Parent / Guardian <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" id="Parent" data-val="true" data-val-required="The Email field is required." name="parent" placeholder=" Parent / Guardian" type="text" value="" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
    
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6">
                            <div class="editor-label">
                                Religion <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control" data-val="true" data-val-required="The Religion field is required." id="Religion" name="religion" onchange="otherregion()" required="">
                                        <option value="">- Choose -</option>
                                        <option value="1">Athiest</option>
                                        <option value="2">Budhist</option>
                                        <option value="3">Christian</option>
                                        <option value="4">Hindu</option>
                                        <option value="5">Jain</option>
                                        <option value="6">Muslim</option>
                                        <option value="7">Sikh</option>
                                        <option value="8">Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-6" id="otherreligion" style="display: none;">
                            <div class="editor-label">
                                Enter Other Religion <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" id="otherreligion" maxlength="20" name="otherreligion" placeholder="Enter Religion" type="text" value="" >
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
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Door / Flat / Plot field is required." id="plotno" maxlength="50" name="plotno" placeholder="Door/ Flat/Plot No" type="text" value="" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Street/ Road Name <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Street / Road field is required." id="streetname" maxlength="50" name="streetname" placeholder="Street/ Road Name" type="text" value="" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Town/ City <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="City field is required." id="city" maxlength="50" name="city" placeholder="Town/ City" type="text" value="" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                District <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The District field is required." id="district" maxlength="50" name="district" placeholder="District" type="text" value="" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                State <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The State field is required." id="state" maxlength="50" name="state" placeholder="State" type="text" value="" oninput="this.value=this.value.replace(/[^A-Za-z]/g,'');" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Pincode <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true"  maxlength="6" data-val-required="The Pincode field is required." id="pincode" maxlength="50" name="pincode" placeholder="Pincode" type="text" value="" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-10">
                            <div class="editor-label">
                                <b>Permanent Address same as Communication Address :If Yes click here</b>
                                <input type="checkbox" name="caspa" id="caspa" style="width:1.5em; height:1.5em; position: relative; display:inline-block; border: 1px solid #a9a9a9; float: right; margin-left: 0.5em;" >
                            </div>
                        </div>
                    </div>
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
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Door / Flat / Plot field is required." id="pplotno" maxlength="50" name="pplotno" placeholder="Door/ Flat/Plot No" type="text" value="" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Street/ Road Name <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Street / Road field is required." id="pstreetname" maxlength="50" name="pstreetname" placeholder="Street/ Road Name" type="text" value="" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Town/ City <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="City field is required." id="pcity" maxlength="50" name="pcity" placeholder="Avenue /Block /Sector" type="text" value="" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                District <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The District field is required." id="pdistrict" maxlength="50" name="pdistrict" placeholder="District" type="text" value="" oninput="this.value=this.value.replace(/[^A-Za-z]/g,'');" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                State <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The State field is required." id="pstate" maxlength="50" name="pstate" placeholder="State" type="text" value="" oninput="this.value=this.value.replace(/[^A-Za-z]/g,'');" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Pincode <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true"  maxlength="6" data-val-required="The Pincode field is required." id="ppincode" maxlength="50" name="ppincode" placeholder="Pincode" type="text" value="" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required="">
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
                                    <select class="form-control" data-val="true" data-val-required="The Community field is required." id="community" name="community" onchange="cmamount()" required="">
                                        <option value="0">- Choose -</option>
                                        <option value="1">BC - Backward Class</option>
                                        <option value="2">BCM - Backward Class Muslims</option>
                                        <option value="3">MBC/DNC-Most Backward
                                                          Class/Denotified Community
                                        </option>
                                        <option value="4">SC - Scheduled Caste</option>
                                        <option value="5">ST - Scheduled Tribe</option>
                                        <option value="6">SCA - Scheduled Caste Arunthathiar</option>
                                        <option value="7">OC / Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                Sub Caste <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
    
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The Subcaste field is required." id="subcaste" maxlength="20" name="subcaste" onkeydown="return true" placeholder="Sub Caste" type="text" value="" required="">
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
                                        Community Certificate file upload<span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input id="Communityfile" name="Communityfile" type="file" value="" onchange="readUR(this);" required="">

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
                                    <select class="form-control" id="IsDifferentlyAbled" data-val="true" data-val-required="Differently Abled Category field is required." name="isdifferentlyabled" onchange="tofd()" required="">
                                        <option value="2">No</option>
                                        <option value="1">Yes</option>
                                    </select>
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
                                        <select class="form-control valid" id="typeofd" name="typeofd">
                                            <option value="0">-Choose-</option>
                                            <option value="1">a)Blindness and low vision</option>
                                            <option value="2">b)Deaf and hard of hearing</option>
                                            <option value="3">c)Locomotor disability including cerebral palsy,
                                                              Leprosy Cured, dwarfism,acid attack victims
                                                              ,and muscular Dystrophy
                                            </option>
                                            <option value="4">d)Autism, intellectual disability,
                                                              specific learning Disability and
                                                              mental illness and Multiple disability
                                                              and Multiple disabilities
                                                              from amongst persons
                                            </option>
                                        </select>
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
                                    <select class="form-control valid" id="iswidow" name="iswidow" required="">
                                        <option value="2">No</option>
                                        <option value="1">Yes</option>
                                    </select>
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
                                    <select class="form-control valid" id="isserviceman" name="isserviceman"  required="">
                                        <option value="2">No</option>
                                        <option value="1">Yes</option>
                                    </select>
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
                                    <select class="form-control valid" id="divorcee" name="divorcee" required="">
                                        <option value="2">No</option>
                                        <option value="1">Yes</option>
                                    </select>
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
                                    <select class="form-control valid" id="refugee" name="refugee" required="">
                                        <option value="2">No</option>
                                        <option value="1">Yes</option>
                                    </select>
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
                                    <select class="form-control valid" id="athlete" name="athlete" required="">
                                        <option value="2">No</option>
                                        <option value="1">Yes</option>
                                    </select>
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
                                        TC Certificate:<span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        <input id="tccertificatefile" name="tccertificatefile" type="file" value="" onchange="readUR(this);" required="">
                                    </div>
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
                                        <select style="width:100px; border:solid 1px #ffffff;" name="slmedium">
                                            <option value="">--Choose--</option>
                                            <option value="tamil">Tamil</option>
                                            <option value="english">English</option>
                                        </select>
        
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" name="slnameinst"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="slYOP" min="1980" max="2018"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="asltotalmark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="aslsecumark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="aslpercentage"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:70px; border:solid 1px #ffffff;" name="slgrade"></td>
                                </tr>
        
                                <tr>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">HSC (+2)
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <select style="width:100px; border:solid 1px #ffffff;" name="hsmedium">
                                            <option value="">--Choose--</option>
                                            <option value="tamil">Tamil</option>
                                            <option value="english">English</option>
                                        </select>
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" name="hsnameinst"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="hsYOP" min="1980" max="2018"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ahstotalmark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ahssecumark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ahspercentage"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:70px; border:solid 1px #ffffff;" name="hsgrade"></td>
                                </tr>
                                <tr>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Degree (3Years)
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <select style="width:100px; border:solid 1px #ffffff;" name="ugmedium">
                                            <option value="">--Choose--</option>
                                            <option value="tamil">Tamil</option>
                                            <option value="english">English</option>
                                        </select></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" name="ugnameinst"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ugYOP" min="1980" max="2018"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ugtotalmark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ugsecumark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="ugpercentage"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:70px; border:solid 1px #ffffff;" name="uggrade"></td>
                                </tr>
                                <tr>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Post Gradguate Degree
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <select style="width:100px; border:solid 1px #ffffff;" name="bgmedium">
                                            <option value="">--Choose--</option>
                                            <option value="tamil">Tamil</option>
                                            <option value="english">English</option>
                                        </select>
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" name="bgnameinst"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="bgYOP" min="1980" max="2018"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="bgtotalmark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="bgsecumark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" name="bgpercentage"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:70px; border:solid 1px #ffffff;" name="bggrade"></td>
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
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        Choose ICM<span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" data-val="true" data-val-required="The icm field is required." id="icm" name="icm" required="">
                                        <option value="" disabled="" selected="">Select an option</option>
                                        <option value="Ramalingam ICM">Ramalingam ICM</option>
                                        <option value="Dr.M.G.R, ICM">Dr.M.G.R, ICM</option>
                                        <option value="Dharmapuri ICM">Dharmapuri ICM</option>
                                        <option value="Dindigul ICM">Dindigul ICM</option>
                                        <option value="Erode ICM">Erode ICM</option>
                                        <option value="Perarignar Anna ICM">Perarignar Anna ICM</option>
                                        <option value="Pandianadu ICM">Pandianadu ICM</option>
                                        <option value="Nagercoil ICM">Nagercoil ICM</option>
                                        <option value="Namakkal ICM">Namakkal ICM</option>
                                        <option value="Nachiappa ICM">Nachiappa ICM</option>
                                        <option value="Thiyagi Sankaralinganar ICM">Thiyagi Sankaralinganar ICM</option>
                                        <option value="Sivagangai ICM">Sivagangai ICM</option>
                                        <option value="Samiappa ICM">Samiappa ICM</option>
                                        <option value="Theni ICM">Theni ICM</option>
                                        <option value="Thiruvannamalai ICM">Thiruvannamalai ICM</option>
                                        <option value="Thiruvarur ICM">Thiruvarur ICM</option>
                                        <option value="M.D.K ICM">M.D.K ICM</option>
                                        <option value="Trichy ICM">Trichy ICM</option>
                                        <option value="Vellore ICM">Vellore ICM</option>
                                        <option value="Villupuram ICM">Villupuram ICM</option>
                                        <option value="Bargur ITI">Bargur ITI</option>
                                        <option value="Pattukkottai ITI">Pattukkottai ITI</option>
                                        <option value="Lalgudi Polytechnic">Lalgudi Polytechnic</option>
                                        <option value="Chennai ICM">Chennai ICM</option>
                                        <option value="Thoothukudi ICM">Thoothukudi ICM</option>
                                      </select>
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
                                    <input type="checkbox" id="declaration1" name="declaration1" data-val="true" data-val-required="This field is required." required=""  style="width:1.5em; height:1.5em; position: relative; display:inline-block; border: 1px solid #a9a9a9; float: left; margin-right: 0.5em;" >

                                        In the state of advanced language training, selected trainers undergo training sessions, adhere to the rules and regulations, and follow the guidelines for examinations and assessment procedures. I am aware of the procedures for registration and application for the examination and certification related to training. I attend the training and participate in the parent association's meetings without any issues, except for reasons beyond my control. I will report and return the training fees collected by the parent association, excluding Kama, and I will strictly adhere to the rules and regulations in Kama's examination department. I voluntarily accept the consequences of not adhering to the regulations of the training state and understand the consequences of non-compliance.
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="checkbox" id="declaration2" name="declaration2" data-val="true" data-val-required="This field is required." required="" style="width:1.5em; height:1.5em; position: relative; display:inline-block; border: 1px solid #a9a9a9; float: left; margin-right: 0.5em;" >
                                        I have submitted my application for employment in various organizations during the days I receive training, but I have not received any response to obtain a job due to the lack of experience. I hereby submit my sincere self-declaration to the authorities for consideration.

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="checkbox" id="declaration3" name="declaration3" data-val="true" data-val-required="This field is required." required="" style="width:1.5em; height:1.5em; position: relative; display:inline-block; border: 1px solid #a9a9a9; float: left; margin-right: 0.5em;" >
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
                                    <input class="form-control" id="Amount" name="Amount" type="text" value="Rs.100" readonly="">
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
                        <div class="col-md-6">
                            <div class="col-sm-6">

                                <div class="row">
            
                                    <div class="col-sm-12">
                                        <div class="editor-label">Upload your Photo</div>
                                    </div>
            
            
                                    <div class="col-sm-12">
                                        <input type="file" onchange="readURL(this);" id="UploadImg" name="UploadImg" required="">
                                        <font color="red"><i> (Jpg / Jpeg / Png) Less than 50 KB</i></font> <br>
                                        <img id="cimage" src="{{asset('images/maleIcon.png')}}" alt="your image" style="margin-top: 10px;width:150px ">
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="field-validation-error" data-valmsg-for="UploadImg" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="editor-label">
                                        Upload your Signature
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <input id="fcsign" name="fcsign" type="file" value="" onchange="readUR(this);" required=""><br>
                                    <font color="red"><i> (png / jpg/ Jpeg) Less than 20 KB</i></font> <br>
                                    <img id="csign" src="{{asset('images/signicon.png')}}" alt="your image" style="margin-top: 30px;width:130px ">
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
                                <input type="submit" name="btnPayment" id="btnPayment" value="Submit Application" class="btnStyle btn btn-primary">
                                <!--                <input type="button" name="btnPayment" id="btnPayment" value="Make Payment" class="btnStyle">-->
                            </p>
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                   
                </fieldset>
            </form>
       </div>
       <div class="col-sm-1 col-md-1 mb-4"></div>
    </div>
 </div>
@endsection