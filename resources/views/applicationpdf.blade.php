<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="theme-color" content="#85AA3B">
      <link rel="shortcut icon" href="assets/images/tamilnadulogo.svg" type="image/vnd.microsoft.icon" />
      <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
      <meta http-equiv="Cache-Control" content="no-store,no-cache,must-revalidate"/>
      <meta http-equiv="Cache-Control" content="pre-check=0,post-check=0,max-age=0" />
      <meta http-equiv="Pragma" content="no-cache"/>
      <meta http-equiv="Expires" content="0"/>
      <meta name="keywords" content="tamil nadu cooperative union" />
      <meta name="description" content="tamil nadu cooperative union"/>
      <meta name="author" content="Government of India" />
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Bootstrap CSS -->
      <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<div class="col-sm-12 col-md-11 mx-auto p-3 body-cards bg-white">
    <div class="row">
        <div class="col-sm-1 col-md-1 mb-4">
        </div>
        <div class="col-sm-10 col-md-10 mb-4">
            <div class="row">
                <div class="col-sm-12 col-md-12 mb-4" style="text-align: center;">
                    <h2> APPLICATION FORM FOR DIPLOMA IN COOPERATIVE MANAGEMENT </h2>
                    <h2> Tamil Nadu Cooperative Union </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-md-8 mb-4"></div>
                <div class="col-sm-4 col-md-4 mb-4" style="text-align: center;">
                    <h5> Application No: {{$Studentdetails['arrn_number']}}</h5>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-8 col-md-8 mb-4">
                    <table class="table table-bordered">
                        <tr>
                            <td>Applied for
                            </td>
                            <td>DIPLOMA IN COOPERATIVE MANAGEMENT
                            </td>
                        </tr>
                        <tr>
                            <td>Advertisement No. and Date:
                            </td>
                            <td>1050/PE3/2017(1-6) 20.06.2018</td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <td>Date of Registration:</td>
                            <td>{{date("d-m-Y",strtotime($Studentdetails['created_at']))}}</td>
                        </tr>
                        <tr>
                            <td>Registration Time:</td>
                            <td>{{date("H:m:s",strtotime($Studentdetails['created_at']))}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-4 col-md-4 mb-4" style="text-align: center;">
                   <img src="/{{$Studentdetails['UploadImg']}}" style="height:200px;width:250px" />
                </div>
            </div>
            <div class=row>
                <div class="col-sm-12 col-md-12 mb-4">
                    <h4>Personal Details</h4>
                </div>
            </div>
            <div class=row>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Name</h4> {{$Studentdetails['fullname']}}
                </div>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Gender</h4> {{$Studentdetails['gender']}}
                </div>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Date of Birth (dd-mm-yyyy)</h4> {{date("d-m-Y",strtotime($Studentdetails['dob']))}}
                </div>
            </div>
            <div class=row>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4> Age (in completed years)</h4> {{$Studentdetails['age']}}
                </div>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Mobile number</h4> {{$Studentdetails['mobile1']}}
                </div>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Alternate mobile number</h4> {{$Studentdetails['mobile2']}}
                </div>
            </div>
            <div class=row>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Aadhar Number</h4> {{$Studentdetails['aadhar']}}
                </div>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Email</h4> {{$Studentdetails['email']}}
                </div>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Parent / Guardian</h4> {{$Studentdetails['parent']}}
                </div>
            </div>
            <div class=row>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Religion</h4> {{$Studentdetails['religion']}}
                </div>
            </div>
            <div class=row>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Address for Communication</h4> {{$Studentdetails['plotno'].','.$Studentdetails['streetname'].','.$Studentdetails['city'].','.$Studentdetails['district'].','.$Studentdetails['state'].','.$Studentdetails['pincode']}}
                </div>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Permanent Address</h4> {{$Studentdetails['pplotno'].','.$Studentdetails['pstreetname'].','.$Studentdetails['pcity'].','.$Studentdetails['pdistrict'].','.$Studentdetails['state'].','.$Studentdetails['ppincode']}}
                </div>
            </div>
            <div class=row>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Community</h4> {{$Studentdetails['religion']}}
                </div>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Differently Abled</h4> {{$Studentdetails['isdifferentlyabled']}}
                </div>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Destitute Widow</h4> {{$Studentdetails['iswidow']}}
                </div>
            </div>
            <div class=row>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Ex-Serviceman Category</h4> {{$Studentdetails['isserviceman']}}
                </div>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Divorcee</h4> {{$Studentdetails['divorcee']}}
                </div>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Refugee from Srilanka or Burma</h4> {{$Studentdetails['refugee']}}
                </div>
            </div>
            <div class=row>
                <div class="col-sm-4 col-md-4 mb-4">
                    <h4>Athlete (National/State/District level)</h4> {{$Studentdetails['athlete']}}
                </div>
            </div>
            <div class=row>
                <div class="col-sm-6 col-md-4 mb-6">
                    <h4>Applicant Signature</h4><img src="/{{$Studentdetails['fcsign']}}" style="height:200px;width:250px" />

                </div>
                <div class="col-sm-6 col-md-4 mb-6">
                    <h4>Parent Signature</h4><img src="/{{$Studentdetails['parentsign']}}" style="height:200px;width:250px" />

                </div>
            </div>
        </div>
       <div class="col-sm-1 col-md-1 mb-4"></div>
    </div>
 </div>
