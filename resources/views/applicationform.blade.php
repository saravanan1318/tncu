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
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        </div>
    </div>
    <div class="row">
        {{-- <div class="col-sm-1 col-md-1 mb-4">
        </div> --}}
       <div class="col-sm-12 col-md-12 mb-4">
        <form action="{{url('store-applicationform')}}" id="regform" enctype="multipart/form-data" method="post" novalidate="novalidate">
            @csrf
            <input type="hidden" id="csrftoken" value="{{csrf_token()}}">
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
                                {{__('form.name')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The Name field is required." id="Name" maxlength="50" name="fullname"  placeholder="Candidate name" type="text" value="{{ old('fullname') }}" style="text-transform: uppercase;" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.gender')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control" data-val="true" data-val-required="The Gender field is required." id="Gender" name="gender" value="{{ old('gender') }}" required="">
                                        <option value="">- {{__('form.select')}}' -</option>
                                        <option value="Male">{{__('form.male')}}</option>
                                        <option value="Female">{{__('form.female')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.dob')}}<span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input  type="text" class="form-control" id="DOB" name="dob" value="{{ old('dob') }}" placeholder="DD-MM-YYYY" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.age')}}<span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The age field is required." id="Age"  name="age" min='18' placeholder="Age" value="{{ old('age') }}" type="text" readonly="" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.mobile')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The Mobilenumber field is required." id="Mobile1" maxlength="10" minlength="10" name="mobile1" placeholder="Mobile" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" min="10" value="{{ old('mobile1') }}" onkeyup="validateLength(this)" required="">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.altmobile')}}
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" id="Mobile2" maxlength="10" name="mobile2" placeholder="Alternate mobile number" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="{{ old('mobile2') }}">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.aadhar')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" id="AadharNumber" minlength="12" maxlength="12" data-val="true" data-val-required="The AadharNumber field is required." name="aadhar" placeholder=" Aadhar Number" type="text" onkeypress="return check(event,value)" oninput="this.value=this.value.replace(/[^0-9]/g,''); checkLength(12,this)" value="{{ old('aadhar') }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.email')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" id="Email" data-val="true" data-val-required="The Email field is required." name="email" placeholder=" Email Id" type="text" value="{{ old('email') }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.pg')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" id="Parent" data-val="true" data-val-required="The Email field is required." name="parent" placeholder=" Parent / Guardian" type="text" value="{{ old('parent') }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.nationality')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true"  maxlength="255" data-val-required="The Nationality field is required." id="nationality" maxlength="255" name="nationality" placeholder="Nationality" type="text" value="{{ old('nationality') }}"  required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.religion')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control" data-val="true" data-val-required="The Religion field is required." id="Religion" name="religion" onchange="otherregion()" value="{{ old('religion') }}" required="">
                                        <option value="">- {{__('form.select')}}-</option>
                                        <option value="Christian">{{__('form.christian')}}</option>
                                        <option value="Hindu">{{__('form.hindu')}}</option>
                                        <option value="Jain">{{__('form.jain')}}</option>
                                        <option value="Muslim">{{__('form.muslim')}}</option>
                                        <option value="Sikh">{{__('form.sikh')}}</option>
                                        <option value="Others">{{__('form.others')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id="otherreligion" style="display: none;">
                            <div class="editor-label">
                                {{__('form.otherreligion')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" id="otherreligion" maxlength="20" name="otherreligion" placeholder="Enter Religion" type="text" value="{{ old('otherreligion') }}" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 subHeadings">
                            <b>{{__('form.address')}}</b>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.door')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Door / Flat / Plot field is required." id="plotno" maxlength="50" name="plotno" placeholder="Door/ Flat/Plot No" type="text" value="{{ old('plotno') }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.street')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Street / Road field is required." id="streetname" maxlength="50" name="streetname" placeholder="Street/ Road Name" type="text" value="{{ old('streetname') }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.city')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="City field is required." id="city" maxlength="50" name="city" placeholder="Town/ City" type="text" value="" required="{{ old('city') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.district')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The District field is required." id="district" maxlength="50" name="district" placeholder="District" type="text" value="{{ old('district') }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.state')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The State field is required." id="state" maxlength="50" name="state" placeholder="State" type="text" value="{{ old('state') }}" oninput="this.value=this.value.replace(/[^A-Za-z]/g,'');" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.pincode')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true"  maxlength="6" data-val-required="The Pincode field is required." id="pincode" maxlength="50" name="pincode" placeholder="Pincode" type="text" value="{{ old('pincode') }}" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required="">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-7">
                            <div class="editor-label">
                                <b> {{__('form.samepermanent')}}</b>
                                <input type="checkbox" name="caspa" id="caspa" style="width:1.5em; height:1.5em; position: relative; display:inline-block; border: 1px solid #a9a9a9; float: right; margin-left: 0.5em;" >
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 subHeadings">
                            <b> {{__('form.Paddress')}}</b>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.door')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Door / Flat / Plot field is required." id="pplotno" maxlength="50" name="pplotno" placeholder="Door/ Flat/Plot No" type="text" value="{{ old('pplotno') }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.street')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="Street / Road field is required." id="pstreetname" maxlength="50" name="pstreetname" placeholder="Street/ Road Name" type="text" value="{{ old('pstreetname') }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.city')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="City field is required." id="pcity" maxlength="50" name="pcity" placeholder="Avenue /Block /Sector" type="text" value="{{ old('pcity') }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.district')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The District field is required." id="pdistrict" maxlength="50" name="pdistrict" placeholder="District" type="text" value="{{ old('pdistrict') }}" oninput="this.value=this.value.replace(/[^A-Za-z]/g,'');" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.state')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The State field is required." id="pstate" maxlength="50" name="pstate" placeholder="State" type="text" value="{{ old('pstate') }}" oninput="this.value=this.value.replace(/[^A-Za-z]/g,'');" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.pincode')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input autocomplete="off" class="form-control" data-val="true"  maxlength="6" data-val-required="The Pincode field is required." id="ppincode" maxlength="50" name="ppincode" placeholder="Pincode" type="text" value="{{ old('ppincode') }}" oninput="this.value=this.value.replace(/[^0-9]/g,'');" required="">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-6">
                            <div class="editor-label">
                                {{__('form.community')}} <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control" data-val="true" data-val-required="The Community field is required." id="community" name="community" value="{{ old('community') }}" required="">
                                        <option value="0">- {{__('form.select')}} -</option>
                                        <option value="BC - Backward Class"> {{__('form.bc')}}</option>
                                        <option value="BC(M) - Backward Class Muslims"> {{__('form.bcm')}}</option>
                                        <option value="MBC/DNC-Most Backward
                                        Class/Denotified Community"> {{__('form.mbc/dnc')}}
                                        </option>
                                        <option value="SC - Scheduled Caste"> {{__('form.sc')}}</option>
                                        <option value="ST - Scheduled Tribe"> {{__('form.st')}}</option>
                                        <option value="SCA - Scheduled Caste Arunthathiar"> {{__('form.sca')}}</option>
                                        <option value="OC / Others"> {{__('form.oc')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="editor-label">
                                Sub Caste <span style="color:red;">*</span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <input autocomplete="off" class="form-control" data-val="true" data-val-required="The Subcaste field is required." id="subcaste" maxlength="20" name="subcaste" onkeydown="return true" placeholder="Sub Caste" type="text" value="" required="">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="clearfix"></div>
                    <div class="row"  style="margin-top: 10px">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        {{__('form.communityupload')}}<span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input id="Communityfile" name="Communityfile" type="file" accept=".png, .jpg, .jpeg" value="{{ old('Communityfile') }}"  required="">

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
                                        {{__('form.pwd')}} <span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="IsDifferentlyAbled" data-val="true" data-val-required="Differently Abled Category field is required." name="isdifferentlyabled" value="{{ old('isdifferentlyabled') }}"  required="">
                                        <option value="">-{{__('form.select')}}-</option>
                                        <option value="No">{{__('form.no')}}</option>
                                        <option value="Yes">{{__('form.yes')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input id="IsDifferentlyAbledfile" name="IsDifferentlyAbledfile" accept=".png, .jpg, .jpeg" style="display: none" type="file" value="{{ old('IsDifferentlyAbledfile') }}"  required="">

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    {{-- <div class="row"  style="margin-top: 10px" style="display: none;" id="typeof">
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
                                            <option value="Blindness and low vision">a)Blindness and low vision</option>
                                            <option value="Deaf and hard of hearing">b)Deaf and hard of hearing</option>
                                            <option value="Locomotor disability including cerebral palsy,
                                            Leprosy Cured, dwarfism,acid attack victims
                                            ,and muscular Dystrophy">c)Locomotor disability including cerebral palsy,
                                                              Leprosy Cured, dwarfism,acid attack victims
                                                              ,and muscular Dystrophy
                                            </option>
                                            <option value="Autism, intellectual disability,
                                            specific learning Disability and
                                            mental illness and Multiple disability
                                            and Multiple disabilities
                                            from amongst persons">d)Autism, intellectual disability,
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
                    <div class="clearfix"></div> --}}
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        {{__('form.widow')}} : <span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control valid" id="iswidow" name="iswidow" value="{{ old('iswidow') }}" required="">
                                        <option value="">-{{__('form.select')}}-</option>
                                        <option value="No">{{__('form.no')}}</option>
                                        <option value="Yes">{{__('form.yes')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input id="iswidowfile" name="iswidowfile" type="file" accept=".png, .jpg, .jpeg" style="display: none" value="{{ old('iswidowfile') }}"  required="">

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
                                        {{__('form.exmilitary')}} : <span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control valid" id="isserviceman" name="isserviceman" value="{{ old('isserviceman') }}"  required="">
                                        <option value="">-{{__('form.select')}}-</option>
                                        <option value="No">{{__('form.no')}}</option>
                                        <option value="Yes">{{__('form.yes')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px;display: none;" id="isservicemandiv" >
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        {{__('form.exmilitaryheir')}} : <span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control valid" id="selectedserviceman" name="selectedserviceman" value="{{ old('selectedserviceman') }}" required="">
                                        <option value="">-{{__('form.select')}}-</option>
                                        <option value="Self">Self</option>
                                        <option value="Wife">{{__('form.wife')}}</option>
                                        <option value="Son">{{__('form.son')}}</option>
                                        <option value="Daughter">{{__('form.daghter')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input id="isservicemanfile" name="isservicemanfile" type="file" accept=".png, .jpg, .jpeg" value="{{ old('isservicemanfile') }}"  required="">

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
                                        {{__('form.divorcee')}}:
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control valid" id="divorcee" name="divorcee" value="{{ old('divorcee') }}" required="">
                                        <option value="">-{{__('form.select')}}-</option>
                                        <option value="No">{{__('form.no')}}</option>
                                        <option value="Yes">{{__('form.yes')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input id="divorceefile" name="divorceefile" type="file" accept=".png, .jpg, .jpeg" style="display: none" value="{{ old('divorceefile') }}"  required="">

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
                                        {{__('form.refugee')}} :
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control valid" id="refugee" name="refugee" value="{{ old('refugee') }}" required="">
                                        <option value="">-{{__('form.select')}}-</option>
                                        <option value="No">{{__('form.no')}}</option>
                                        <option value="Yes">{{__('form.yes')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input id="refugeefile" name="refugeefile" type="file" accept=".png, .jpg, .jpeg" style="display: none" value="{{ old('refugeefile') }}"  required="">

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
                                        {{__('form.athlete')}} : <span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control valid" id="athlete" name="athlete" value="{{ old('athlete') }}" required="">
                                        <option value="">-{{__('form.select')}}-</option>
                                        <option value="No">{{__('form.no')}}</option>
                                        <option value="Yes">{{__('form.yes')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input id="athletefile" name="athletefile" type="file" accept=".png, .jpg, .jpeg" style="display: none" value="{{ old('athletefile') }}"  required="">

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
                                        {{__('form.tc')}}:<span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="editor-label">
                                        <input id="tccertificatefile" name="tccertificatefile" type="file" accept=".png, .jpg, .jpeg" value="{{ old('tccertificatefile') }}"  required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-sm-12 subHeadings">
                            <b>{{__('form.edu')}}</b>
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
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">{{__('form.edu')}}
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">{{__('form.mi')}}</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">Certificate No.</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">{{__('form.inst')}}</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">{{__('form.year')}}</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">{{__('form.tm')}}</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">{{__('form.ms')}}</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"> {{__('form.percentage')}}</td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">{{__('form.grade')}}</td>
                                </tr>

                                <tr>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">{{__('form.sslc')}}<span style="color:red;">*</span>
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <select style="width:100px; border:solid 1px #ffffff;" id="slmedium" name="slmedium">
                                            <option value="">--{{__('form.choose')}}--</option>
                                            <option value="Tamil">{{__('form.tamil')}}</option>
                                            <option value="English">{{__('form.english')}}</option>
                                        </select>

                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" id="slcertificateno" name="slcertificateno" value="{{ old('slcertificateno') }}" required=""></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" id="slnameinst" name="slnameinst" value="{{ old('slnameinst') }}" required=""></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="slYOP" name="slYOP" value="{{ old('slYOP') }}" min="1980" max="2023" required=""></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="asltotalmark" value="{{ old('asltotalmark') }}" name="asltotalmark" required=""></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="aslsecumark" value="{{ old('aslsecumark') }}" name="aslsecumark" required=""></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="aslpercentage" value="{{ old('aslpercentage') }}" name="aslpercentage" readonly></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="file" accept=".png, .jpg, .jpeg" style="width:200px; border:solid 1px #ffffff;" name="slgrade" id="slgrade" value="{{ old('slgrade') }}" required=""></td>
                                </tr>

                                <tr>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <select style="width:120px; border:solid 1px #ffffff;" id="hsordiploma" name="hsordiploma" required="">
                                            <option value="">--{{__('form.choose')}}<span style="color:red;">*</span>--</option>
                                            <option value="{{__('form.hsc')}}">{{__('form.hsc')}}</option>
                                            <option value="Diploma(3 Years)">Diploma (3 Years)</option>
                                        </select>
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <select style="width:100px; border:solid 1px #ffffff;" id="hsmedium" name="hsmedium" required="">
                                            <option value="">--{{__('form.choose')}}--</option>
                                            <option value="Tamil">{{__('form.tamil')}}l</option>
                                            <option value="English">{{__('form.english')}}</option>
                                        </select>
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" id="hscertificateno" name="hscertificateno" value="{{ old('hscertificateno') }}" required=""></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" id="hsnameinst" name="hsnameinst" value="{{ old('hsnameinst') }}" required=""></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="hsYOP" name="hsYOP" value="{{ old('hsYOP') }}" min="1980" max="2023" required=""></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="ahstotalmark" value="{{ old('ahstotalmark') }}" name="ahstotalmark" required=""></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="ahssecumark" value="{{ old('ahssecumark') }}" name="ahssecumark" required=""></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="ahspercentage" value="{{ old('ahspercentage') }}" name="ahspercentage" readonly></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="file"  accept=".png, .jpg, .jpeg" style="width:200px; border:solid 1px #ffffff;" name="hsgrade" id="hsgrade"  value="{{ old('hsgrade') }}" required=""></td>
                                </tr>
                                <tr>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">{{__('form.degree')}}
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <select style="width:100px; border:solid 1px #ffffff;" id="ugmedium" name="ugmedium">
                                            <option value="">--{{__('form.choose')}}--</option>
                                            <option value="Tamil">{{__('form.tamil')}}</option>
                                            <option value="English">{{__('form.english')}}</option>
                                        </select></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" id="ugcertificateno" name="ugcertificateno" value="{{ old('ugcertificateno') }}"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" id="ugnameinst" name="ugnameinst" value="{{ old('ugnameinst') }}"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="ugYOP" name="ugYOP" value="{{ old('ugYOP') }}" min="1980" max="2023"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="ugtotalmark" value="{{ old('ugtotalmark') }}" name="ugtotalmark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="ugsecumark" value="{{ old('ugpercentage') }}" name="ugsecumark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="ugpercentage" value="{{ old('ugpercentage') }}" name="ugpercentage" readonly></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="file" accept=".png, .jpg, .jpeg" style="width:200px; border:solid 1px #ffffff;" name="uggrade" id="uggrade" value="{{ old('uggrade') }}"></td>
                                </tr>
                                <tr>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">{{__('form.graduation')}}
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;">
                                        <select style="width:100px; border:solid 1px #ffffff;" id="bgmedium" name="bgmedium">
                                            <option value="">--{{__('form.choose')}}--</option>
                                            <option value="Tamil">{{__('form.tamil')}}</option>
                                            <option value="English">{{__('form.english')}}</option>
                                        </select>
                                    </td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" id="bgcertificateno" name="bgcertificateno" value="{{ old('bgcertificateno') }}"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="text" style="width:150px; border:solid 1px #ffffff;" id="bgnameinst" name="bgnameinst" value="{{ old('bgnameinst') }}"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="bgYOP" name="bgYOP" value="{{ old('bgYOP') }}" min="1980" max="2023"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="bgtotalmark" value="{{ old('bgtotalmark') }}" name="bgtotalmark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="bgsecumark" value="{{ old('bgsecumark') }}" name="bgsecumark"></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="number" style="width:100px; border:solid 1px #ffffff;" id="bgpercentage" value="{{ old('bgpercentage') }}" name="bgpercentage" readonly></td>
                                    <td style=" border:1px solid #b0b0b0; padding:3px;"><input type="file" accept=".png, .jpg, .jpeg" style="width:200px; border:solid 1px #ffffff;" name="bggrade" id="bggrade" value="{{ old('bggrade') }}"></td>
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
                                        {{__('form.icm')}}<span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control" data-val="true" data-val-required="The icm field is required." id="icm" name="icm" value="{{ old('icm') }}" required="">
                                        <option value="">- {{__('form.select')}}' -</option>
                                        @foreach ($icmlists as $icmlist)
                                            <option value="{{ $icmlist->id }}" >{{ $icmlist->icm_name }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-12 subHeadings">
                            <b>{{__('form.declaration')}}</b>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;text-align:justify">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="checkbox" id="declaration1" name="declaration1" data-val="true" data-val-required="This field is required." required=""  style="width:1.5em; height:1.5em; position: relative; display:inline-block; border: 1px solid #a9a9a9; float: left; margin-right: 0.5em;" >
                                    {{__('form.details')}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="checkbox" id="declaration2" name="declaration2" data-val="true" data-val-required="This field is required." required="" style="width:1.5em; height:1.5em; position: relative; display:inline-block; border: 1px solid #a9a9a9; float: left; margin-right: 0.5em;" >
                                    {{__('form.details2')}} .

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="checkbox" id="declaration3" name="declaration3" data-val="true" data-val-required="This field is required." required="" style="width:1.5em; height:1.5em; position: relative; display:inline-block; border: 1px solid #a9a9a9; float: left; margin-right: 0.5em;" >
                                    {{__('form.details3')}}.
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-12 subHeadings">
                            <b>{{__('form.Pdeclaration')}}</b>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="checkbox" id="declaration3" name="declaration3" data-val="true" data-val-required="This field is required." required="" style="width:1.5em; height:1.5em; position: relative; display:inline-block; border: 1px solid #a9a9a9; float: left; margin-right: 0.5em;" >
                            {{__('form.details4')}}.
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-12 subHeadings">
                            <b>{{__('form.pay')}}</b>
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
                        <div class="col-md-2">
                            <div class="editor-label">
                                Payment Type<span style="color:red;">*</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control" data-val="true" data-val-required="The Payment Type field is required." id="paymenttype" name="paymenttype" required="">
                                        <option value="">- {{__('form.select')}}' -</option>
                                        <option value="online">online</option>
                                        <option value="offline">offline</option>
                                        <option value="qrpayment">QR Payment</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    <div class="row" style="margin-top: 10px;display: none;" id="paymenttypediv" >
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Challan No.</label>
                                    <input class="form-control" id="challonno" name="challonno" type="text" placeholder="Challan No"  value="{{ old('challonno') }}" required="">
                                </div>
                                <div class="col-md-3">
                                    <label>Bank Name</label>
                                    <input class="form-control" id="bankname" name="bankname" type="text"  placeholder="Bank Name" value="{{ old('bankname') }}"  required="">
                                </div>
                                <div class="col-md-3">
                                    <label>Branch Name</label>
                                    <input class="form-control" id="paymentdistrict" name="paymentdistrict" type="text"  placeholder="Branch Name" value="{{ old('paymentdistrict') }}"  required="">
                                </div>
                                <div class="col-md-3">
                                    <label>Upload Challon</label>
                                    <input id="challonfile" name="challonfile" type="file" accept=".png, .jpg, .jpeg" value="" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;display: none;" id="qrdiv" >
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <img id="qrcode" src="{{asset('images/qrcode.jpeg')}}" alt="qrcode" style="margin-top: 10px;width:150px ">
                                </div>
                                <div class="col-md-3">
                                    <label>UPI ID.</label>
                                    <input class="form-control" id="upiid" name="upiid" type="text" placeholder="xyz123@okicici"  value="{{ old('upiid') }}" required="">
                                </div>
                                <div class="col-md-3">
                                    <label>Transaction No.</label>
                                    <input class="form-control" id="transno" name="transno" type="text"  placeholder="Transaction No." value="{{ old('transno') }}"  required="">
                                </div>
                                <div class="col-md-3">
                                    <label>Payment Screenshot</label>
                                    <input id="qrpaymentscreenshotfile" name="qrpaymentscreenshotfile" type="file" accept=".png, .jpg, .jpeg" value="" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-12 subHeadings">
                            <b>{{__('form.docs')}}</b>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-md-4">
                            <div class="col-sm-6">

                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="editor-label">{{__('form.photo')}}<span style="color:red;">*</span></div>
                                    </div>


                                    <div class="col-sm-12">
                                        <input type="file" accept=".png, .jpg, .jpeg" onchange="readURL1(this);" id="UploadImg" name="UploadImg" required="">
                                        <font color="red"><i> {{__('form.less')}}</i></font> <br>
                                        <img id="image1" src="{{asset('images/maleIcon.png')}}" alt="your image" style="margin-top: 10px;width:150px ">
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="field-validation-error" data-valmsg-for="UploadImg" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="editor-label">
                                        {{__('form.sign')}}<span style="color:red;">*</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <input id="fcsign" name="fcsign" type="file" accept=".png, .jpg, .jpeg" value="" onchange="readUR2(this);" required=""><br>
                                    <font color="red"><i>{{__('form.lessthan')}}</i></font> <br>
                                    <img id="image2" src="{{asset('images/signicon.png')}}" alt="your image" style="margin-top: 30px;width:130px ">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="editor-label">
                                        {{__('form.psign')}}<span style="color:red;">*</span>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <input id="parentsign" name="parentsign" type="file" accept=".png, .jpg, .jpeg" value="" onchange="readUR3(this);" required=""><br>
                                    <font color="red"><i> {{__('form.lessthan')}}</i></font> <br>
                                    <img id="image3" src="{{asset('images/signicon.png')}}" alt="your image" style="margin-top: 30px;width:130px ">
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
                                <button name="Preview" id="Preview" value="Submit Application" class="btn btn-primary">
                                    Preview
                                </button>
                                <div class="modal fade" id="largeModal" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" style="text-align: center">APPLICATION FORM FOR DIPLOMA IN COOPERATIVE MANAGEMENT <br> Tamil Nadu Cooperative Union</h5>
                                        </div>
                                        <div class="modal-body" id="forminputs">

                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" onclick="modalclose()">Edit</button>
                                          <input type="button" name="btnPayment" id="btnPayment" class="btnStyle btn btn-primary" value="Submit Application">
                                        </div>
                                      </div>
                                    </div>
                                </div><!-- End Large Modal-->
                                <!--                <input type="button" name="btnPayment" id="btnPayment" value="Make Payment" class="btnStyle">-->
                            </p>
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                </fieldset>
            </form>
       </div>
       {{-- <div class="col-sm-1 col-md-1 mb-4"></div> --}}
    </div>
 </div>
<script>
    
    function modalclose(){
        $('#largeModal').modal('hide');   
    }
  
  
</script>
@endsection
