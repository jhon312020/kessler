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
 <!-- Main content -->
  <section class="page-section" id="jsTraineeMessage">
    <div class="container">
      <!-- Contact Section Heading-->
      <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Session Completed</h2>
      <!-- Icon Divider-->
      <div class="divider-custom">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
        <div class="divider-custom-line"></div>
      </div>
      <div class="row">
        <div class="col-lg-8 mx-auto">
        <p>Thanks and you have successfully completed the first round of your session!</p>
        <br>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="form-group text-center">
          <button class="btn btn-primary btn-xl" id="jsStartSession" type="submit">HOME</button>
        </div>
      </div>
    </div>
      <!-- /.container-fluid -->
  </section>
 @endsection  
<!-- /.content -->