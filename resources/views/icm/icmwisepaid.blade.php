@extends('icm.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ICM wise paid List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ICM wise paid List</li>
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
                <div class="col-md-12">
                <table id="applicationlist" class="table table-bordered mb-5">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">#</th>
                            <th scope="col">Application no.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Term 1</th>
                            <th scope="col">Term 2</th>
                            <th scope="col">Term 3</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $count = 1;
                        ?>
                        @foreach($studentDatas as $studentData)
                        <tr>
                            <th scope="row">{{ $count++ }}</th>
                            <td>{{ $studentData->admission_number}}</td>
                            <td>{{ $studentData->fullname }}</td>
                            <td>{{ $studentData->term1 }}</td>
                            <td>{{ $studentData->term2 }}</td>
                            <td>{{ $studentData->term3 }}</td>
                            <td>{{ date('d-m-Y  H:i:s',strtotime($studentData->created_at)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Pagination --}}
                {{-- {!! $studentDatas->links() !!} --}}
            </div>
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
