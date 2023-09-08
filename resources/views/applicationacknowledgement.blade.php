@extends('layouts.master')

@section('content')
<div class="col-sm-12 col-md-12 mx-auto p-3 body-cards bg-white">
    <div class="row" style="font-size:20px">
        <div class="col-md-2">
        </div>
        <div class="col-md-8" style="text-align: center">
           <p style="color: green"> Congratulations <br> Your Application number generated successfully </p><br>
           <h2> Full Name: {{$Studentdetails->fullname}}</h2>
           <h2> Email: {{$Studentdetails->email}}</h2>
           <h2> ARN No: {{$Studentdetails->arrn_number}}</h2>
           <a class="btn btn-success" href="/applicationpdf/{{$Studentdetails->id}}" target="_blank"> Download Application </a>
        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>
@endsection
