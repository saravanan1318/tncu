@extends('icm.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Print version List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Male List</li>
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
                        <th scope="col">Sl No</th>
                        <th scope="col">ARN Number</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Mobile No</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Age</th>
                        <th scope="col">Aadhaar No</th>
                        <th scope="col">10th Org Verfied <br> Yes / No</th>
                        <th scope="col">12th/Dip Org Verfied <br> Yes / No</th>
                        <th scope="col">Degree Org Verfied <br> Yes / No</th>
                        <th scope="col">PG Org Verfied <br> Yes / No</th>
                        <th scope="col">TC Org Verfied <br> Yes / No</th>
                        <th scope="col">Community Org Verfied <br> Yes / No</th>
                        <th scope="col">UPI No. / Challon No </th>
                        <th scope="col">Selected/Not Selected</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                      $count = 1;
                    ?>
                    @foreach($studentDatas as $studentData)
                    <?php  
                         $trn = "";

                        if(!is_null($studentData->challonno) && !is_null($studentData->transno)){
                            $trn = $studentData->transno." / ".$studentData->challonno;
                        }else if(!is_null($studentData->challonno) && is_null($studentData->transno)){
                            $trn = $studentData->challonno;
                        }else if(is_null($studentData->challonno) && !is_null($studentData->transno)){
                            $trn = $studentData->transno;
                        }else{
                            $trn = $studentData->transno;
                        }
                    ?>
                    <tr>
                        <th scope="row">{{ $count++ }}</th>
                        <td>{{ $studentData->arrn_number }} <input type="hidden" id="icmname" value="{{ $studentData->mtr_icm->icm_name }} "></td>
                        <td>{{ $studentData->fullname }}</td>
                        <td>{{ $studentData->mobile1 }}</td>
                        <td>{{ date("d-m-Y",strtotime($studentData->dob)) }}</td>
                        <td>{{ $studentData->age }}</td>
                        <td>{{ $studentData->aadhar }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $trn }}</td>
                        <td></td>
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
