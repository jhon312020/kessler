<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kessler Foundation</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  </head>
  @isset($page)
    <body class="main-body grey-background" oncopy = 'return false' oncut = 'return false' onselectstart = 'return false'>
  @else
    <body class="main-body white-background" oncopy = 'return false' oncut = 'return false' onselectstart = 'return false'>
  @endisset
    <main role="main" class="container">
      <div id="header">
        <img src="{{asset('assets/img/logo.png')}}" alt="logo" />
      </div>
      <div class="starter-template">
        @yield('content')
      </div>

    </main><!-- /.container -->
    <div id="footer">
      @isset($page)
        <img src="{{asset('assets/img/footer_grey.png')}}" class="center" width="90%"/>
      @else 
        <img src="{{asset('assets/img/footer_white.png')}}" class="center" width="90%"/>
      @endisset
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/confetti.min.js')}}"></script>
    <script type='text/javascript'>
      if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
      }
      $(document).ready(function() {
          $('body').bind('contextmenu cut copy paste', function (e) {
            e.preventDefault();
          });
      });
    </script>
  </body>
</html>