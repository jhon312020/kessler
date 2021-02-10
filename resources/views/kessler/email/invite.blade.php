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
  <body style="text-align: center">
    <!-- Page Content -->
    <div id="container" class="container grey-background" style="width: 60%">
      <div id="header">
        <img src="{{asset('assets/img/logo.png')}}" alt="logo" width="600px" />
      </div>
        <section>
          <div class="row">
            <div class="col-lg-12 text-center">
              <p>Hi {{ $name }},</p>
              <h1>Welcome to<br> Modified Story Memory Technique</h1>
              <h3 class="heading2">Your Username is</h3> {{ $email }}
              <h3 class="heading2">Your Password is</h3> {{ $password }}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 mx-auto">
              <h3>Click <a href={{ route('login') }}>here</a> to login into your account</h3>
            </div>
          </div>
        </section>
      <div id="footer">
        <img src="{{asset('assets/img/footer.png')}}" width="600px" class="center"/>
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  </body>
</html>