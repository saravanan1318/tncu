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
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Transaction details</h3>
                    </div>
                    <!-- /.card-header -->
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
                      <div class="row">
                        <div class="col-sm-4">
                          
                        </div>
                        <div class="col-sm-4">
                          <div class="position-relative p-3 bg-gray" style="height: 180px">
                            <div class="ribbon-wrapper ribbon-xl">
                              <div class="ribbon bg-success">
                                PAID AMOUNT (Rs.)
                              </div>
                            </div>
                            <h2 style="margin-top: 50px">{{$amountpaid}} </h2>
                          </div>
                        </div>
                        <div class="col-sm-4">
                         
                        </div>
                      </div>
                      <br>
                      @if($balancetopay != 0)
                        <div class="row">
                            <div class="col-sm-4">
                            
                            </div>
                            <div class="col-sm-4">
                                <form action="{{url('/student/invoice/store')}}" method="POST">
                                    @csrf
                                    <label>Balance amount to be pay:</label>
                                    <input class="form-control" type="number" name="termamount" value="{{$balancetopay}}" id="termamount"  required/>
                                    <button type="submit" style="text-align: center;margin-top:10px" class="btn btn-primary" >PAY NOW</button>
                                </form>
                            </div>
                            <div class="col-sm-4">
                            
                            </div>
                        </div>
                      @endif
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
          </section>
          <!-- /.content-wrapper -->
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
