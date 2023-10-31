@extends('student.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Payment verify</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Payment verify</li>
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
                        <h1 class="card-title">Payment verify</h1>
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
                        <div> 
                            <a class="btn  btn-outline-success" href="studentdashboard" id="reloadButton">Go to Dashboard</a></div>
                        </div>
                        @endif
                            @if(!isset($returnMessage))
                            <form id="paymentForm" method="POST">
                                <input type="hidden" name="invoiceNo" value="{{$invoiceNo}}" >
                                <div class="row p-4">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-lg-3 mr-2">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-lg-3 mr-2">
                                        <div class="position-relative p-3 bg-gray" style="height: 180px">
                                            <strong>Amount:</strong> {{$amount}}<br>
                                            <strong>Payment Ref No:</strong> {{$invoiceNo}}<br>
                                            <strong>Payment Ref Date:</strong> {{ date("d-m-Y",strtotime($invoiceDate))}}<br>
                                        </div>
                                    </div>
                                </div>    
                                <div class="row p-4 ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-lg-3 mr-2" style="text-align: center">
                                        <button type="submit" id="paymentbtn" class="btn btn-lg btn-outline-success ">PROCEED TO PAY</button>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-lg-3 mr-2">
                                    </div>
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
