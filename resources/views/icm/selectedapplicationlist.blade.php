@extends('icm.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
        <div class="row">
            <table class="table table-responsive table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">ARN Number</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Aadhaar No</th>
                        <th scope="col">Marks secured</th>
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
                        <th scope="col">Profile Photo</th>
                        <th scope="col">Application</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
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
                        <th scope="row">{{ $studentData->id }}</th>
                        <td>{{ $studentData->arrn_number }}</td>
                        <td>{{ $studentData->fullname }}</td>
                        <td>{{ $studentData->age }}</td>
                        <td>{{ $studentData->aadhar }}</td>
                        <td>{{ $markssecured }}</td>
                        <td><a href="#" onclick="modalopen(this.id)" id="Communityfile" data-href="/{{$studentData->Communityfile}}" >{{$studentData->community}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="isdifferentlyabledfile" data-href="/{{$studentData->isdifferentlyabledfile}}" >{{$studentData->isdifferentlyabled}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="iswidowfile" data-href="/{{$studentData->iswidowfile}}" >{{$studentData->iswidow}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="isservicemanfile" data-href="/{{$studentData->divorceefile}}" >{{$studentData->isserviceman}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="divorceefile" data-href="/{{$studentData->divorceefile}}" >{{$studentData->divorcee}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="refugeefile" data-href="/{{$studentData->refugeefile}}" >{{$studentData->refugee}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="athletefile" data-href="/{{$studentData->athletefile}}" >{{$studentData->athlete}}</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="tccertificatefile" data-href="/{{$studentData->tccertificatefile}}" >view</a></td>
                        <td><a href="#" onclick="modalopen(this.id)" id="challonfile" data-href="/{{$studentData->challonfile}}" >{{ $studentData->challonno }}</a></td>
                        <td>{{ $studentData->bankname }}</td>
                        <td>{{ $studentData->paymentdistrict }}</td>
                        <td><a href="#" onclick="modalopen(this.id)" id="challonfile" data-href="/{{$studentData->UploadImg}}" >view</a></td>
                        <td><a href='/applicationreview/{{$studentData->id}}'>view</a></td>
                        <td>{{ $status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Pagination --}}
            {!! $studentDatas->links() !!}
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
        <div class="modal-body">
            <img src="" id="modalimage">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
  </script>
  @endsection
