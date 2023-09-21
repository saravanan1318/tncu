<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ICM</title>
  @include('icm.partials.styles')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    @include('icm.partials.header')
    @yield('content')
    @include('icm.partials.footer')
    </div>
    @include('icm.partials.scripts')
</body>
</html>
