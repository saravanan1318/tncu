<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ICM</title>
  @include('icm.partials.styles')
</head>
<body class="hold-transition login-page">
    <div class="login-box">
    @yield('content')
    </div>
    @include('icm.partials.scripts')
</body>
</html>