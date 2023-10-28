@extends('student.layouts.master')
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
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->



        <div class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h1 class="card-title">Payments</h1>
                    </div>
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
                        <div> <a class="btn  btn-outline-success" href="studentdashboard" id="reloadButton">Go to Dashboard</a></div>
                        </div>
                        @endif
                            @if(!isset($returnMessage))
                        <form id="paymentForm" method="POST">
                            <div class="row p-4">
                            <div class="bg-teal col-lg-3 col-md-3 col-sm-6 col-xs-12 p-lg-3 mr-2">
                                <div class="dashboard-stat2 bordered">
                                    <div class="loading" style="z-index: 100; position: absolute; min-height: 100%; margin-top: 6px; left: 40%; top: 34%; display: none;">
                                        <i class="fa fa-spinner fa-spin fa-fw" style="font-size:50px; color:#ec9a9a;"></i>
                                    </div>
                                    <div style="height: 85px; display: none;" class="DisplaytempDiv"></div>
                                    <div class="display" style="">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <input name="terms[]" value="1" type="checkbox"> <small>TERM 1</small>
                                            </h3>
                                            <small>Tuition Fees</small>
                                            <small>RS.6750</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-warning col-lg-3 col-md-3 col-sm-6 col-xs-12 p-lg-3 mr-2">
                                <div class="dashboard-stat2 bordered">
                                    <div class="loading" style="z-index: 100; position: absolute; min-height: 100%; margin-top: 6px; left: 40%; top: 34%; display: none;">
                                        <i class="fa fa-spinner fa-spin fa-fw" style="font-size:50px; color:#ec9a9a;"></i>
                                    </div>
                                    <div style="height: 85px; display: none;" class="DisplaytempDiv"></div>
                                    <div class="display" style="">
                                        <div class="number">
                                            <h3 class="font-green-sharp">
                                                <input name="terms[]" value="2" type="checkbox"> <small>TERM 2</small>
                                            </h3>
                                            <small>Tuition Fees</small>
                                            <small>RS.6000</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="bg-teal col-lg-3 col-md-3 col-sm-6 col-xs-12 p-lg-3 mr-2">
                                    <div class="dashboard-stat2 bordered">
                                        <div class="loading" style="z-index: 100; position: absolute; min-height: 100%; margin-top: 6px; left: 40%; top: 34%; display: none;">
                                            <i class="fa fa-spinner fa-spin fa-fw" style="font-size:50px; color:#ec9a9a;"></i>
                                        </div>
                                        <div style="height: 85px; display: none;" class="DisplaytempDiv"></div>
                                        <div class="display" style="">
                                            <div class="number">
                                                <h3 class="font-green-sharp">
                                                    <input name="terms[]" value="3" type="checkbox"> <small>TERM 3</small>
                                                </h3>
                                                <small>Tuition Fees</small>
                                                <small>RS.6000</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-4 ">
                            <button type="submit" id="paymentbtn" class="btn btn-lg btn-outline-success ">Pay Now</button>
                            </div>
                        </form>
                            @endif
                        <div id="error-message" style="color: red; display: none;">Please select at least one Term.</div>
                    </div>
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
