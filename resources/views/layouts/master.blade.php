
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="theme-color" content="#85AA3B">
      <link rel="shortcut icon" href="assets/images/tamilnadulogo.svg" type="image/vnd.microsoft.icon" />
      <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
      <meta http-equiv="Cache-Control" content="no-store,no-cache,must-revalidate"/>
      <meta http-equiv="Cache-Control" content="pre-check=0,post-check=0,max-age=0" />
      <meta http-equiv="Pragma" content="no-cache"/>
      <meta http-equiv="Expires" content="0"/>
      <meta name="keywords" content="tamil nadu cooperative union" />
      <meta name="description" content="tamil nadu cooperative union"/>
      <meta name="author" content="Government of India" />
      <meta name="csrf-token" content="{{ csrf_token() }}">

  @include('partials.styles')
</head>
<body>
<div class="container-fluid">
    <div class="row ">
        <!-- topbar -->
        <div class="d-md-block d-lg-block d-xl-block w-100 topbar">
            <div class="col-md-11 mx-auto h-100">
                <div class="d-inline-block w-100">
                    <div class="d-inline float-right">
                        <ul class="navbar-nav d-inline">
                            <li class="nav-item d-inline"><a href="?lang={{ __('header.shortlang') }}">{{ __('header.lang') }}</a> | </li>
                        </ul>
                        <ul class="navbar-nav d-inline">
                            <li class="nav-item d-inline"><a href="/login?lang={{ __('header.shortlang') }}">Login</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /topbar -->
    </div>
    <div class="row">
        <div class="bgimg">
            <div class="col-sm-12 col-md-12 mx-auto mt-2">
                <div class="row no-gutters">
@include('partials.header')
@yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')

@include('partials.scripts')

</body>
</html>
