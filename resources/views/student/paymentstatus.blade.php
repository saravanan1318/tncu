@extends('student.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tuition Fees</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tuition Fees</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <!-- /.row -->
        <div class="content">
            <div class="container-fluid">
              <div class="card card-default">
                  <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                          <h1 class="card-title">Payment status</h1>
                        </div>                        <!-- /.col -->
                      </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    @if(isset($returnMessage))
                        <div>
                          @if($returnMessage=="SUCCESS")
                            <div class="alert alert-success">
                                <center>
                                <i class="fas fa-check-circle"></i>
                                <strong>Success!</strong> Your Payment was completed successfully.<br>
                                    <strong>Amount:</strong> {{$amount}}<br>
                                <strong>Transaction ID:</strong> {{$transactionid}}<br>
                                <strong>Transaction Date:</strong> {{$transaction_date}}<br>

                                </center>
                            </div>
                          @endif
                          @if($returnMessage=="ERROR")
                            <div class="alert alert-danger">
                                <center>
                                <i class="fas fa-exclamation-circle"></i>
                                <strong>Error!</strong> Your payment was unsuccessful. Please check your details and try again.<br>
                                @if(isset($transactionid) && isset($transaction_date))
                                    <strong>Amount:</strong> {{$amount}}<br>
                                    <strong>Transaction ID:</strong> {{$transactionid}}<br>
                                    <strong>Transaction Date:</strong> {{$transaction_date}}<br>
                                @endif
                                </center>
                            </div>
                          @endif
                          <div> 
                            <a class="btn  btn-outline-success" href="studentdashboard" id="reloadButton">Go to Dashboard</a></div>
                          </div>
                        </div>
                    @endif
                  </div>
                </div>
            </div>
            <!-- /.container-fluid -->
          </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
