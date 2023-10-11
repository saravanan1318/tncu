@extends('icm.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Generate Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Generate Invoice</li>
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
              <h1 class="card-title">INVOICE</h1>
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
              <form action="{{url('/icm/invoice/store')}}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                      <label>BILL FROM: </label>
                      <p>{{ Auth::user()->name }}</p>
                      <p>{{ $icm->add1.", ".$icm->add2.", ".$icm->city.", ".$icm->pincode }}</p>
                  </div>
                  <div class="col-md-6">
                      <p><b>Invoice Date : </b>{{date("d-m-Y")}}</p>
                      <p><b>Invoice No : </b>{{'INV'.Auth::user()->id.'-'.Auth::user()->invoiceNo+1;}}</p>
                  </div>
                  <!-- /.col -->
              </div>                                                                                
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>BILL TO: </label>
                    <select class="form-control select2" name="student_id" required>
                      <option value="" selected="selected">Select</option>
                      <?php
                      foreach($studentDatas as $studentData){
                      ?>
                        <option value="{{$studentData->id}}">{{$studentData->arrn_number}}</option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>PAYMENT MODE: </label>
                    <select class="form-control" name="payment_mode" required>
                      <option value="">Select</option>
                      <option value="CASH">CASH</option>
                      <option value="QR PAYMENT">QR PAYMENT</option>
                      <option value="BANK CHALLAN">BANK CHALLAN</option>
                    </select>
                  </div>
                </div>
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
                          <th style="text-align: center">Price</th>
                          <th style="text-align: center">Total</th>
                          <th style="text-align: center">Action</th>
                        </tr>
                      </thead>
                      <tbody id="tablebody">
                        <tr class="row1">
                          <td>1</td>
                          <td>
                            <select class="form-control term" name="term[]" id="term1" data-id="1" required>
                              <option value="">SELECT</option>
                              <option value="TUITION FESS - TERM 1">TUITION FESS - TERM 1</option>
                              <option value="TUITION FESS - TERM 2">TUITION FESS - TERM 2</option>
                              <option value="TUITION FESS - TERM 3">TUITION FESS - TERM 3</option>
                            </select>
                          </td>
                          <td style="text-align: center">
                            01
                          </td>
                          <td style="text-align: center">
                            <input type="number" name="termamount[]" value="" id="termamount1" data-id="1"  required/>
                          </td>
                          <td style="text-align: center">
                            <input type="number" name="termtotal[]" value="" id="termtotal1" data-id="1"  required/>
                          </td>
                          <td style="text-align: center">
                            {{-- <a class="deletebtn btn btn-danger" id="deletebtn1" data-id="1">Delete row</a> --}}
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
                    <div class="row">
                      <div class="col-md-10" style="text-align: center">
                      </div>
                      <div class="col-md-2">
                        <a class="btn btn-warning" id="addnew" data-rowid="1">Add new</a>
                      </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-4" style="text-align: center">
                    <button type="submit" class="btn btn-primary" >SUBMIT</button>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
    // var postData = {arrn_number: };
    // $.ajax({
    //     type: "GET",
    //     url: "/icm/selectedlist", // Replace with the actual URL or Laravel route
    //     data: postData,
    //     success: function (response) {
    //         // Handle the response from the server
    //         //location.reload();
    //         alert(response.message);
    //         location.reload();
    //         console.log(response);

    //     },
    //     error: function (xhr, status, error) {
    //         // Handle any errors
    //         console.error(xhr.responseText);
    //     }
    // });
  </script>
  @endsection
