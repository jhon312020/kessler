{{-- @extends('msmt.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <link href="{{asset('css/app.css')}}" rel="stylesheet" />
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content" id="jsTraineeMessage">
      <br><br>
      <div class="container-fluid" >
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Session Completed</h3>
          </div> <!-- /.card-body -->
          <div class="card-body">
            <h1 class="m-0"></h1>
            <p>Thanks and you have successfully completed the first round of your session!
            </p>       
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary float-right">Home</button>
          </div>
        </div>
      </div>
      <br><br>
      <!-- /.container-fluid -->
    </section>
@endsection --}}

@extends('msmt.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <link href="{{asset('css/app.css')}}" rel="stylesheet" />
  <div class="content-wrapper">

             <!-- Main content -->
        <section class="page-section">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">CONGRATULATIONS</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                <p class="text-center">You have successfully completed the {{ $round }} round of your session! Please contact your traineer!!!</p>
                <br>
                </div>
              </div>
 
                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                            <br />
                            <div id="success"></div>
                            <div class="form-group text-center"><button class="btn btn-primary btn-xl" id="jsHome" type="submit">Home</button></div>
                    </div>
                </div>
            </div>
              <!-- /.container-fluid -->
        </section>

<script type="text/javascript">
  $(document).ready( function() { 
   $(document).on('click', '#jsHome', function(event) { 
      window.location.replace('/home');
    });
  })
</script>
@endsection