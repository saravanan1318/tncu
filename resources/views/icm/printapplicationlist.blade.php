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
{{--            <button class="btn btn-info p-2 applyactionbutton">apply</button>--}}
            <table id="applicationlist" class="table table-responsive table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">ICM Name</th>
                        <th scope="col">ARN Number</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Aadhaar No</th>
                        <th scope="col">Marks secured</th>
                        <th scope="col">Mark sheet files</th>
                        <th scope="col">Community</th>
                        <th scope="col">Challon No</th>
                        <th scope="col">Bank Name</th>
                        <th scope="col">Payment District</th>
                        <th scope="col">UPI ID</th>
                        <th scope="col">UPI Transaction No.</th>
                        <th scope="col">Payment Transaction screenshot</th>
                        <th>Address</th>
                        <th>contact Number</th>
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
{{--                        <td>{{ $studentData->mtr_icm->icm_name }}</td>--}}
                        <td>{{ $studentData->icm_name }}</td>
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
                        <td><a href="#" onclick="modalopen(this.id)" id="challonfile{{ $studentData->id }}" data-href="/{{$studentData->challonfile}}" >{{ $studentData->challonno }}</a></td>
                        <td>{{ $studentData->bankname }}</td>
                        <td>{{ $studentData->paymentdistrict }}</td>
                        <td>{{ $studentData->upiid }}</td>
                        <td>{{ $studentData->transno }}</td>
                        <td><a href="#" onclick="modalopen(this.id)" id="qrpaymentscreenshotfile{{ $studentData->id }}" data-href="/{{$studentData->qrpaymentscreenshotfile}}" >view</a></td>
                        <td>{{$studentData->plotno}},{{$studentData->streetname}},{{$studentData->city}},{{$studentData->district}},{{$studentData->state}},{{$studentData->pincode}}</td>
                        <td>{{$studentData->mobile1}}/{{$studentData->mobile2}}</td>
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
