@extends('icm.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">ARN Number</th>
                        <th scope="col">Full name</th>
                        <th scope="col">View Application</th>
                        <th scope="col">View TC certificate</th>
                        <th scope="col">View Community certificate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studentDatas as $studentData)
                    <tr>
                        <th scope="row">{{ $studentData->id }}</th>
                        <td>{{ $studentData->arn_number }}</td>
                        <td>{{ $studentData->fullname }}</td>
                        <td><a href='/applicationreview/{{$studentData->id}}'>view</a></td>
                        <td><a href='/{{$studentData->tccertificatefile}}'>view</a></td>
                        <td><a href='/{{$studentData->Communityfile}}'>view</a></td>
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
  @endsection