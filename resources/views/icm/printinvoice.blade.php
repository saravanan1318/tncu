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



    <div class="content" id="DivIdToPrint">
      <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
              <h1 class="card-title">INVOICE</h1>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                      <label>BILL FROM: </label>
                      <p>{{ Auth::user()->name }}</p>
                  </div>
                  <div class="col-md-6">
                      <p><b>Invoice Date : </b>{{date("d-m-Y",strtotime($invoicedetails[0]->created_at))}}</p>
                      <p><b>Invoice No : </b>{{$invoicedetails[0]->invoiceNo}}</p>
                  </div>
                  <!-- /.col -->
              </div>                                                                                
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>BILL TO: </label>
                    <p>
                        <b>Name : </b> {{$studentData->fullname}}
                    </p>
                    <p>
                        <b>Address : </b> {{$studentData->plotno.", ".$studentData->streetname.", ".$studentData->city.", ".$studentData->district.", ".$studentData->state.", ".$studentData->pincode}}
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  
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
                        </tr>
                      </thead>
                      <tbody id="tablebody">

                        <?php
                        $total = 0;
                        $count = 0;
                        foreach($invoicedetails as $invoicedetail){
                        ?>
                            <tr class="row1">
                                <td>{{++$count}}</td>
                                <td>
                                    {{$invoicedetail->term}}
                                </td>
                                <td style="text-align: center">
                                01
                                </td>
                                <td style="text-align: center">
                                    {{$invoicedetail->amount}}
                                </td>
                                <td style="text-align: center">
                                    {{$invoicedetail->amount}}
                                </td>
                            </tr>
                        <?php
                         $total += $invoicedetail->amount;
                        }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="4" style="text-align: right">
                            <b>Total</b>
                          </td>
                          <td style="text-align: center">
                            {{$total}}
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-4">
            
        </div>
        <div class="col-md-4" style="text-align: center">
            <a class="btn btn-primary" onclick='printDiv();' >PRINT</a>
        </div>
        <div class="col-md-4">
            
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

    function printDiv() 
    {

    var divToPrint=document.getElementById('DivIdToPrint');

    var newWin=window.open('','Print-Window');

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

    newWin.document.close();

    setTimeout(function(){newWin.close();},10);

    }

  </script>
  @endsection
