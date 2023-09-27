@extends('icm.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Selected Application</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Selected Application</li>
              <li class="breadcrumb-item active">ICM</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="content">
            <div class="container-fluid">
              <div class="row table-responsive">
                  <table id="applicationlist" class="table table-responsive table-bordered mb-5">
                      <thead>
                          <tr class="table-success">
                              <th scope="col">#</th>
                              <th scope="col">ICM Name</th>
                              <th scope="col">No of application</th>
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
                              <td>{{ $studentData->icm_name}}</td>
                              <td>{{ $studentData->Noofapps }}</td>
                              <td><a href='/icm/selectedapplicationlist/{{$studentData->id}}/Female'>view</a></td>
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
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
