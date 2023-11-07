@extends('icm.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Applications</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Applications</li>
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
                              <th scope="col">Total Application</th>
                              <th scope="col">PayTM Amount</th>
                              <th scope="col">Bank Challon Amount</th>
                              <th scope="col">Total Amount</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php  
                            $count = 1;
                            $sumamountreceived = 0;
                            $sumupiamount = 0;
                            $sumchequeamount = 0;
                          ?>
                          @foreach($studentDatas as $studentData)
                          <tr>
                              <th scope="row">{{ $count++ }}</th>
                              <td>{{ $studentData->icm_name}}</td>
                              <td><a href='/icm/totalapplications/{{$studentData->id}}'>{{ $studentData->total }}</a></td>
                              <td><a href='/icm/upiapplications/{{$studentData->id}}'>{{ $studentData->upiamount }}</a></td>
                              <td><a href='/icm/challonapplications/{{$studentData->id}}'>{{ $studentData->chequeamount }}</a></td>
                              <td><a href='#'>{{ $studentData->amountreceived }}</a></td>
                          </tr>
                          <?php  
                            $sumamountreceived +=  $studentData->amountreceived;
                            $sumupiamount += $studentData->upiamount;
                            $sumchequeamount += $studentData->chequeamount;
                          ?>
                          @endforeach
                      </tbody>
                      <tfoot>
                        <tr class="table-success">
                            <th scope="col" colspan="3" style="text-align: right;">Total</th>
                            <th scope="col">{{$sumupiamount}}</th>
                            <th scope="col">{{$sumchequeamount}}</th>
                            <th scope="col">{{$sumamountreceived}}</th>
                        </tr>
                    </tfoot>
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
