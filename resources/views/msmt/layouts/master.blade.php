<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Kessler Foundation</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  </head>
  <body>
    <!-- Page Content -->
    <div id="container" class="container {{ $background ?? 'white-background' }}">
      <div id="header">
        <img src="{{asset('assets/img/logo.png')}}" alt="logo" />
      </div>
        @yield('content')
      <div id="footer">
        <img src="{{asset('assets/img/footer.png')}}" class="center"/>
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/confetti.min.js')}}"></script>
  </body>
</html>