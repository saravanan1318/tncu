@extends('student.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Invoice List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice List</li>
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
              <div class="card-body">
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
                <table id="applicationlist" class="table table-bordered mb-5">
                    <thead>
                        <tr class="table-success">
                            <th scope="col">#</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Application No</th>
                            <th scope="col">Full name</th>
                            <th scope="col">Aadhar</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                          $count = 1;
                        ?>
                        @foreach($studentDatas as $studentData)
                        <tr>
                            <th scope="row">{{ $count++ }}</th>
                            <td>{{ $studentData->invoiceNo}}</td>
                            <td>{{ $studentData->admission_number}}</td>
                            <td>{{ $studentData->fullname}}</td>
                            <td>{{ $studentData->aadhar}}</td>
                            <td>{{ $studentData->amount}}</td>
                            <td><a href='/icm/printinvoice/{{$studentData->invoiceNo}}'>Download</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           
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
