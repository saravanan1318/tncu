@extends('icm.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Challon Application List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Challon Application List</li>
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
            <table id="applicationlist" class="table table-responsive table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">ICM Name</th>
                        <th scope="col">ARN Number</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Aadhaar No</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Challon No</th>
                        <th scope="col">Bank Name</th>
                        <th scope="col">Payment District</th>
                        <th scope="col">UPI ID</th>
                        <th scope="col">UPI Transaction No.</th>
                        <th scope="col">Payment Transaction screenshot</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                      $count = 1;
                    ?>
                    @foreach($studentDatas as $studentData)
                    <?php 
                    $status = "Pending";
                    if($studentData->status == 1 ){
                      $status = "Selected";
                    }

                    ?>
                    <tr>
                        <th scope="row">{{ $count++ }}</th>
                        <td>{{ $studentData->mtr_icm->icm_name }}</td>
                        <td>{{ $studentData->arrn_number }}</td>
                        <td>{{ $studentData->fullname }}</td>
                        <td>{{ $studentData->age }}</td>
                        <td>{{ $studentData->aadhar }}</td>
                        <td>{{ $studentData->Amount }}</td>
                        <td><a href="#" onclick="modalopen(this.id)" id="challonfile{{ $studentData->id }}" data-href="/{{$studentData->challonfile}}" >{{ $studentData->challonno }}</a></td>
                        <td>{{ $studentData->bankname }}</td>
                        <td>{{ $studentData->paymentdistrict }}</td>
                        <td>{{ $studentData->upiid }}</td>
                        <td>{{ $studentData->transno }}</td>
                        <td><a href="#" onclick="modalopen(this.id)" id="qrpaymentscreenshotfile{{ $studentData->id }}" data-href="/{{$studentData->qrpaymentscreenshotfile}}" >view</a></td>
                        <td>{{  $status }}</td>
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
