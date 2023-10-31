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
                        <h1 class="card-title">{{$icm->icm_name}}</h1>
                      </div>
                      <div class="col-md-4" style="text-align: right !important;color:green">
                        <h1 class="card-title">ALREADY FESS PAID : {{$amountpaid}}</h1>
                      </div>
                      <!-- /.col -->
                    </div>
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
                    <form action="{{url('/student/invoice/store')}}" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col-md-6">
                            <label>TO: </label>
                            <p>{{ Auth::user()->name }}</p>
                            <p>{{ $icm->add1.", ".$icm->add2.", ".$icm->city.", ".$icm->pincode }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><b>ARN No : </b>{{$studentDatas[0]->arrn_number}}</p>
                            <p><b>Receipt Date : </b>{{date("d-m-Y")}}</p>
                            <p><b>Receipt No : </b>{{'PAY_'.Auth::user()->id.'-'.Auth::user()->invoiceNo+1;}}</p>
                        </div>
                        <!-- /.col -->
                      </div>
                    <!-- /.row -->
                    <div class="row">
                      <div class="col-md-12">
                          <table class="table table-bordered thead-dark">
                            <thead style="background-color: #9ac4ed; border-color: #fff;">
                              <tr>
                                <th>Sno.</th>
                                <th >Description</th>
                                <th style="text-align: center">Quantity</th>
                                <th style="text-align: center">Balance fees</th>
                              </tr>
                            </thead>
                            <tbody id="tablebody">
                              <tr class="row1">
                                <td>1</td>
                                <td>
                                  <select class="form-control term" name="term" id="term1" data-id="1" required>
                                    <option value="TUITION FESS">TUITION FESS</option>
                                  </select>
                                </td>
                                <td style="text-align: center">
                                  01
                                </td>
                                <td style="text-align: center">
                                  <input type="number" name="termamount" value="{{$balancetopay}}" id="termamount" data-id="1" min="1"  required/>
                                </td>
                              </tr>
                            </tbody>
                            {{-- <tfoot>
                              <tr>
                                <td style="text-align: center">
                                  Total
                                </td>
                                <td style="text-align: center">
      
                                </td>
                              </tr>
                            </tfoot> --}}
                          </table>
                          </div>
                      </div>
                    </div>
                    <div class="row" style="margin: 5px;">
                      <div class="col-md-4">
                          
                      </div>
                      <div class="col-md-4" style="text-align: center">
                          <button type="submit" class="btn btn-primary" >PAY NOW</button>
                      </div>
                      <div class="col-md-4">
                          
                      </div>
                    </div>
                    </form>
                    
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
