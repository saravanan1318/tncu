@extends('icm.layouts.login')
@section('content')
<div class="login-logo">
    <b>Tamil Nadu Cooperative Union</b>
</div>
<!-- /.login-logo -->
<div class="card">
<div class="card-body login-card-body">
    <p class="login-box-msg" style="font-size: 30px">ICM LOGIN</p>
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
    <form action="{{url('checklogin')}}" id="icmloginform" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="editor-label">
                    Email ID <span style="color:red;">*</span>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Email" name="email" data-val="true" data-val-required="The Name field is required." required="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <div class="editor-label">
                    Password <span style="color:red;">*</span>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="password" class="form-control" placeholder="Password" name="password" data-val="true" data-val-required="The Password field is required." required="">

                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 20px">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="icmsignin">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    <!-- /.social-auth-links -->
</div>
<!-- /.login-card-body -->
@endsection