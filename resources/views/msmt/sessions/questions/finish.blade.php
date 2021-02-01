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
                <p class="text-center">You have successfully finished the {{ $round }} round of your session! Please contact your traineer!!!</p>
                <br>
                </div>
              </div>
 
                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                            <br />
                            <div id="success"></div>
                            <div class="form-group text-center">
                            <a href="{{ url('/home') }}" class="btn btn-primary btn-xl" id="jsHome" type="submit">Home
                            </a>
                          </div>
                    </div>
                </div>
            </div>
              <!-- /.container-fluid -->
        </section>
@endsection