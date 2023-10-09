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
        <div class="row p-4">
            <div class="bg-gradient-white col-lg-3 col-md-3 col-sm-6 col-xs-12 p-lg-3 mr-2">
                <a href="/icm/icmwiselist" class="dashboard-stat2 bordered">
                    <div class="loading" style="z-index: 100; position: absolute; min-height: 100%; margin-top: 6px; left: 40%; top: 34%; display: none;">
                        <i class="fa fa-spinner fa-spin fa-fw" style="font-size:50px; color:#ec9a9a;"></i>
                    </div>
                    <div style="height: 85px; display: none;" class="DisplaytempDiv"></div>
                    <div class="display" style="">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span id="ToltalSMSSent" data-counter="counterup">{{$data[0]['allapplication']}}</span>
                            </h3>
                            <small>Total ICM Applications received</small>
                        </div>
                        <div class="icon">
                            <i class="icon-envelope"></i>
                        </div>
                    </div>
                    <div class="progress-info" style="">
                        <div class="progress">
                    <span id="spnSMSSent" class="progress-bar progress-bar-success green-sharp" style="width: 90%;">

                    </span>
                        </div>
                        <div class="status">

                        </div>
                    </div>
                </a>
            </div>
            <div class="bg-gradient-white col-lg-3 col-md-3 col-sm-6 col-xs-12 p-lg-3 mr-2">
                <div class="dashboard-stat2 bordered">
                    <div class="loading" style="z-index: 100; position: absolute; min-height: 100%; margin-top: 6px; left: 40%; top: 34%; display: none;">
                        <i class="fa fa-spinner fa-spin fa-fw" style="font-size:50px; color:#ec9a9a;"></i>
                    </div>
                    <div style="height: 85px; display: none;" class="DisplaytempDiv"></div>
                    <div class="display" style="">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span id="ToltalSMSSent" data-counter="counterup">{{$data[0]['selectedapplication']}}</span>
                            </h3>
                            <small>Selected Application</small>
                        </div>
                        <div class="icon">
                            <i class="icon-envelope"></i>
                        </div>
                    </div>
                    <div class="progress-info" style="">
                        <div class="progress">
                    <span id="spnSMSSent" class="progress-bar bg-success green-sharp" style="width: 100%;">

                    </span>
                        </div>
                        <div class="status">

                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-white col-lg-3 col-md-3 col-sm-6 col-xs-12 p-lg-3 mr-2">
                <div class="dashboard-stat2 bordered">
                    <div class="loading" style="z-index: 100; position: absolute; min-height: 100%; margin-top: 6px; left: 40%; top: 34%; display: none;">
                        <i class="fa fa-spinner fa-spin fa-fw" style="font-size:50px; color:#ec9a9a;"></i>
                    </div>
                    <div style="height: 85px; display: none;" class="DisplaytempDiv"></div>
                    <div class="display" style="">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span id="ToltalSMSSent" data-counter="counterup">{{$data[0]['pendingapplication']}}</span>
                            </h3>
                            <small>Pending Applications</small>
                        </div>
                        <div class="icon">
                            <i class="icon-envelope"></i>
                        </div>
                    </div>
                    <div class="progress-info" style="">
                        <div class="progress">
                    <span id="spnSMSSent" class="progress-bar bg-danger green-sharp" style="width: 90%;">

                    </span>
                        </div>
                        <div class="status">

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row p-4">
            <div class="bg-gradient-white col-lg-3 col-md-3 col-sm-6 col-xs-12 p-lg-3 mr-2">
                <a href="/icm/icmwise/paidreport" class="dashboard-stat2 bordered">
                    <div class="loading" style="z-index: 100; position: absolute; min-height: 100%; margin-top: 6px; left: 40%; top: 34%; display: none;">
                        <i class="fa fa-spinner fa-spin fa-fw" style="font-size:50px; color:#ec9a9a;"></i>
                    </div>
                    <div style="height: 85px; display: none;" class="DisplaytempDiv"></div>
                    <div class="display" style="">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span id="ToltalSMSSent" data-counter="counterup">{{$data[0]['totalcount']}}</span>
                            </h3>
                            <small>Total Invoice generated</small>
                        </div>
                        <div class="icon">
                            <i class="icon-envelope"></i>
                        </div>
                    </div>
                    <div class="progress-info" style="">
                        <div class="progress">
                    <span id="spnSMSSent" class="progress-bar progress-bar-success green-sharp" style="width: 90%;">
    
                    </span>
                        </div>
                        <div class="status">
    
                        </div>
                    </div>
                </a>
            </div>
            <div class="bg-gradient-white col-lg-3 col-md-3 col-sm-6 col-xs-12 p-lg-3 mr-2">
                <div class="dashboard-stat2 bordered">
                    <div class="loading" style="z-index: 100; position: absolute; min-height: 100%; margin-top: 6px; left: 40%; top: 34%; display: none;">
                        <i class="fa fa-spinner fa-spin fa-fw" style="font-size:50px; color:#ec9a9a;"></i>
                    </div>
                    <div style="height: 85px; display: none;" class="DisplaytempDiv"></div>
                    <div class="display" style="">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span id="ToltalSMSSent" data-counter="counterup">{{$data[0]['totalamount']}}</span>
                            </h3>
                            <small>Total Invoice amount received</small>
                        </div>
                        <div class="icon">
                            <i class="icon-envelope"></i>
                        </div>
                    </div>
                    <div class="progress-info" style="">
                        <div class="progress">
                    <span id="spnSMSSent" class="progress-bar bg-success green-sharp" style="width: 100%;">
    
                    </span>
                        </div>
                        <div class="status">
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
              <div class="row table-responsive">
                  <table id="applicationlist" class="table table-responsive table-bordered mb-5">
                      <thead>
                          <tr class="table-success">
                              <th scope="col">#</th>
                              <th scope="col">ICM Name</th>
                              <th scope="col">Total Application</th>
                              <th scope="col">Selected Application</th>
                              <th scope="col">Not Selected Application</th>
                              <th scope="col">Duplicate Application</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php  
                            $count = 1;
                          ?>
                          @foreach($studentDatas as $studentData)
                          <tr>
                              <th scope="row">{{ $count++ }}</th>
                              <td>{{ $studentData->icm_name}}</td>
                              <td><a href='/icm/icmapplicationlist/{{$studentData->id}}'>{{ $studentData->total }}</a></td>
                              <td><a href='/icm/selectedapplicationlist/{{$studentData->id}}'>{{ $studentData->selected }}</a></td>
                              <td><a href='/icm/notselectedapplicationlist/{{$studentData->id}}'>{{ $studentData->notselected }}</a></td>
                              <td><a href='/icm/duplicatedapplicationlist/{{$studentData->id}}'>{{ $studentData->duplicate }}</a></td>
                          </tr>
                          @endforeach
                      </tbody>
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
