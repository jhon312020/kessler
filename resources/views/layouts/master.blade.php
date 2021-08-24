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
  <body oncopy = 'return false' oncut = 'return false' onmousedown = 'return false' onselectstart = 'return false'>
    <!-- Page Content -->
    <div id="container" class="container grey-background" style="padding-bottom: 0px;">
      <div id="header">
        <img src="{{asset('assets/img/logo.png')}}" alt="logo" />
      </div>
        @yield('content')
      <div id="footer1">
        <img src="{{asset('assets/img/footer.png')}}" class="center"/>
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript">
      $(document).ready(function() {
          $(".disableEvent").on("contextmenu",function() {
             return false;
          }); 
          $('.disableEvent').bind('cut copy paste', function (e) {
            e.preventDefault();
          });
      });
  </script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  </body>
</html>