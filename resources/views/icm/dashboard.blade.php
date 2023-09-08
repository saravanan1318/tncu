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
                <div class="dashboard-stat2 bordered">
                    <div class="loading" style="z-index: 100; position: absolute; min-height: 100%; margin-top: 6px; left: 40%; top: 34%; display: none;">
                        <i class="fa fa-spinner fa-spin fa-fw" style="font-size:50px; color:#ec9a9a;"></i>
                    </div>
                    <div style="height: 85px; display: none;" class="DisplaytempDiv"></div>
                    <div class="display" style="">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span id="ToltalSMSSent" data-counter="counterup">5</span>
                            </h3>
                            <small>Total Application</small>
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
                                <span id="ToltalSMSSent" data-counter="counterup">5</span>
                            </h3>
                            <small>Approved Application</small>
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
                                <span id="ToltalSMSSent" data-counter="counterup">5</span>
                            </h3>
                            <small>Pending Application</small>
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

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
