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
        <div class="row table-responsive">
          <table id="applicationlist" class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">ICM Name</th>
                    <th scope="col">ARN Number</th>
                    <th scope="col">Full name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Aadhaar No</th>
                    <th scope="col" colspan="2">Marks secured</th>
                    <th scope="col" colspan="2">TC</th>
                    <th scope="col" colspan="2">Community certificate</th>
                    <th scope="col">UPI Transaction No. / Challon No</th>
                </tr>
                <tr class="table-success">
                    <th scope="col" colspan="6"></th>
                    <th scope="col">Verified</th>
                    <th scope="col">Not Verified</th>
                    <th scope="col">Verified</th>
                    <th scope="col">Not Verified</th>
                    <th scope="col">Verified</th>
                    <th scope="col">Not Verified</th>
                    <th scope="col"></th>
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

                ?>
                <tr>
                    <th scope="row">{{ $count++ }}</th>
                    <td>{{ $studentData->mtr_icm->icm_name }}</td>
                    <td>{{ $studentData->arrn_number }}</td>
                    <td>{{ $studentData->fullname }}</td>
                    <td>{{ $studentData->age }}</td>
                    <td>{{ $studentData->aadhar }}</td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>{{ $studentData->transno }} / {{ $studentData->challonno }}</td>
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
