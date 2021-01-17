@extends('msmt.layouts.master')
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
            <h3 class="card-title">START CUES</h3>
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
@endsection