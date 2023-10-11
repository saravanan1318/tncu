@extends('icm.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Invoice</li>
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
              <form action="{{url('/icm/invoice/edit')}}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                      <label>BILL FROM: </label>
                      <p>{{ Auth::user()->name }}</p>
                      <p>{{ $icm->add1.", ".$icm->add2.", ".$icm->city.", ".$icm->pincode }}</p>
                      <input type="hidden" value="{{$invoiceNo}}" name="invoiceNo" >
                  </div>
                  <div class="col-md-6">
                      <p><b>Invoice Date : </b>{{date("d-m-Y",strtotime($invoicedetails[0]->created_at))}}</p>
                      <p><b>Invoice No : </b>{{$invoiceNo}}</p>
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
                        <option value="{{$studentData->id}}" {{ $StudentParams['id'] === $studentData->id ? "selected" : "" }}>{{$studentData->arrn_number}}</option>
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
                      <option value="CASH" {{ $invoicedetails[0]->payment_mode === "CASH" ? "selected" : "" }}>CASH</option>
                      <option value="QR PAYMENT" {{ $invoicedetails[0]->payment_mode === "QR PAYMENT" ? "selected" : "" }}>QR PAYMENT</option>
                      <option value="BANK CHALLAN" {{ $invoicedetails[0]->payment_mode === "BANK CHALLAN" ? "selected" : "" }}>BANK CHALLAN</option>
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
                        @foreach ($invoicedetails as $invoice)
                            <tr class="row{{$loop->iteration}}">
                                <td>{{$loop->iteration}}</td>
                                <td>
                                <select class="form-control term" name="term[]" id="term{{$loop->iteration}}" data-id="{{$loop->iteration}}" required>
                                    <option value="">SELECT</option>
                                    <option value="TUITION FESS - TERM 1" {{ $invoice->term === "TUITION FESS - TERM 1" ? "selected" : "" }} >TUITION FESS - TERM 1</option>
                                    <option value="TUITION FESS - TERM 2" {{ $invoice->term === "TUITION FESS - TERM 2" ? "selected" : "" }} >TUITION FESS - TERM 2</option>
                                    <option value="TUITION FESS - TERM 3" {{ $invoice->term === "TUITION FESS - TERM 3" ? "selected" : "" }} >TUITION FESS - TERM 3</option>
                                </select>
                                </td>
                                <td style="text-align: center">
                                01
                                </td>
                                <td style="text-align: center">
                                <input type="number" name="termamount[]" id="termamount{{$loop->iteration}}" data-id="{{$loop->iteration}}" value="{{$invoice->amount}}"  required/>
                                </td>
                                <td style="text-align: center">
                                <input type="number" name="termtotal[]" id="termtotal{{$loop->iteration}}" data-id="{{$loop->iteration}}" value="{{$invoice->amount}}"  required/>
                                </td>
                                <td style="text-align: center">
                                    @if ($loop->first)
                                        {{-- <a class="deletebtn btn btn-danger" id="deletebtn{{$loop->iteration}}" data-id="{{$loop->iteration}}">Delete row</a> --}}
                                    @elseif ($loop->last)
                                        <a class="deletebtn btn btn-danger" id="deletebtn{{$loop->iteration}}" data-id="{{$loop->iteration}}">Delete row</a>
                                    @else
                                        <a class="deletebtn btn btn-danger" id="deletebtn{{$loop->iteration}}" data-id="{{$loop->iteration}}" style="display:none">Delete row</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="row">
                      <div class="col-md-10" style="text-align: center">
                      </div>
                      <div class="col-md-2">
                        <a class="btn btn-warning" id="addnew" data-rowid="{{count($invoicedetails)}}">Add new</a>
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
