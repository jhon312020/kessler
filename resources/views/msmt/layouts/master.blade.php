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
  @isset($page)
  <body class="grey-background">
  @else
  <body class="white-background">
  @endisset
    <!-- Page Content -->
    <div id="container" class="container ">
      <div id="header">
        <img src="{{asset('assets/img/logo.png')}}" alt="logo" />
      </div>
        @yield('content')
      <div id="footer">
        @isset($page)
          <img src="{{asset('assets/img/footer_grey.png')}}" class="center"/>
        @else 
          <img src="{{asset('assets/img/footer_white.png')}}" class="center"/>
        @endisset
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/confetti.min.js')}}"></script>
    <script type='text/javascript'>
      if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
      }
  </script>
  </body>
</html>