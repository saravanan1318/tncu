@extends('icm.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Application List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Application List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row table-responsive">
            <div class=""><button class="btn btn-info p-2 applyactionbutton">apply</button></div>
            <br>
            <table id="applicationlist" class="table table-responsive table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th>checkbox</th>
                        <th scope="col">ICM Name</th>
                        <th scope="col">ARN Number</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Aadhaar No</th>
                        <th scope="col">Marks secured</th>
                        <th scope="col">Mark sheet files</th>
                        <th scope="col">Community</th>
                        <th scope="col">Is disabled</th>
                        <th scope="col">Widow</th>
                        <th scope="col">Ex-Serviceman</th>
                        <th scope="col">Divorcee</th>
                        <th scope="col">Refugee</th>
                        <th scope="col">Athlete</th>
                        <th scope="col">TC</th>
                        <th scope="col">Challon No</th>
                        <th scope="col">Bank Name</th>
                        <th scope="col">Payment District</th>
                        <th scope="col">UPI ID</th>
                        <th scope="col">UPI Transaction No.</th>
                        <th scope="col">Payment Transaction screenshot</th>
                        <th scope="col">Profile Photo</th>
                        <th scope="col">Application</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      $count = 1;
                    ?>
                    @foreach($studentDatas as $studentData)
                    <?php
                    $markssecured = "";
                    if(!empty($studentData->aslsecumark)){
                      $markssecured .=  "SSLC -".$studentData->aslsecumark;
                    }
                    if(!empty($studentData->ahssecumark)){
                      $markssecured .=  ", ".$studentData->hsordiploma." - ".$studentData->ahssecumark;
                    }
                    if(!empty($studentData->ugsecumark)){
                      $markssecured .=  ", UG -".$studentData->ugsecumark;
                    }
                    if(!empty($studentData->bgsecumark)){
                      $markssecured .=  ", PG -".$studentData->bgsecumark;
                    }

                    $status = "Pending";
                    if($studentData->status == 1 ){
                      $status = "Selected";
                    }

                    ?>
                    <tr>
                        <th scope="row">{{ $count++ }}</th>
<td><input type="checkbox" class="checkbox" value="{{ $studentData->id }}"></td>
{{--                        <td>{{ $studentData->mtr_icm->icm_name }}</td>--}}
                        <td>{{ $studentData->mtr_icm->icm_name }}</td>
                        <td>{{ $studentData->arrn_number }}</td>
                        <td>{{ $studentData->fullname }}</td>
                        <td>{{ $studentData->age }}</td>
                        <td>{{ $studentData->aadhar }}</td>
                        <td>{{ $markssecured }}</td>
                        <td>
                          <a href="#" onclick="modalopen(this.id)" id="slgrade{{ $studentData->id }}" data-href="/{{$studentData->slgrade}}" >10th</a>
                          <a href="#" onclick="modalopen(this.id)" id="hsgrade{{ $studentData->id }}" data-href="/{{$studentData->hsgrade}}" >12th/Diploma</a>
                          <a href="#" onclick="modalopen(this.id)" id="uggrade{{ $studentData->id }}" data-href="/{{$studentData->uggrade}}" >UG</a>
                          <a href="#" onclick="modalopen(this.id)" id="bggrade{{ $studentData->id }}" data-href="/{{$studentData->bggrade}}" >PG</a>
                        </td>
                        <td><a href="#" onclick="modalopen(this.id)" id="Communityfile{{ $studentData->id }}" data-href="/{{$studentData->Communityfile}}" >{{$studentData->community}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="isdifferentlyabledfile{{ $studentData->id }}" data-href="/{{$studentData->isdifferentlyabledfile}}" >{{$studentData->isdifferentlyabled}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="iswidowfile{{ $studentData->id }}" data-href="/{{$studentData->iswidowfile}}" >{{$studentData->iswidow}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="divorceefile{{ $studentData->id }}" data-href="/{{$studentData->divorceefile}}" >{{$studentData->isserviceman}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="divorceefile{{ $studentData->id }}" data-href="/{{$studentData->divorceefile}}" >{{$studentData->divorcee}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="refugeefile{{ $studentData->id }}" data-href="/{{$studentData->refugeefile}}" >{{$studentData->refugee}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="athletefile{{ $studentData->id }}" data-href="/{{$studentData->athletefile}}" >{{$studentData->athlete}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="tccertificatefile{{ $studentData->id }}" data-href="/{{$studentData->tccertificatefile}}" >view</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="challonfile{{ $studentData->id }}" data-href="/{{$studentData->challonfile}}" >{{ $studentData->challonno }}</a></td>
                        <td>{{ $studentData->bankname }}</td>
                        <td>{{ $studentData->paymentdistrict }}</td>
                        <td>{{ $studentData->upiid }}</td>
                        <td>{{ $studentData->transno }}</td>
                        <td><a href="#" onclick="modalopen(this.id)" id="qrpaymentscreenshotfile{{ $studentData->id }}" data-href="/{{$studentData->qrpaymentscreenshotfile}}" >view</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="UploadImg{{ $studentData->id }}" data-href="/{{$studentData->UploadImg}}" >view</a></td>
                        <td><a href='/uploads/applications/{{$studentData->arrn_number}}.pdf'>view</a></td>
                        <td>SUCCESS</td>
                        <td><a class="btn btn-sm btn-info text-white" href="/icm/applicationregenerate?id={{$studentData->id}}">Regenerate</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Pagination --}}
            {{-- {!! $studentDatas->links() !!} --}}
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body" style="text-align: center">
            <img src="" id="modalimage" style="width: 150px;height:150px">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="modalclose()" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div><!-- End Basic Modal-->
  <script>
    function modalopen(id){
      var imgsrc = $("#"+id).attr("data-href");
      $("#modalimage").attr("src",imgsrc);
      $('#basicModal').modal('show');
    }
    function modalclose(){
        $('#basicModal').modal('hide');
    }
  </script>
  @endsection
