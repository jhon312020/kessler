@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
<link href="{{asset('css/style.css')}}" rel="stylesheet" />
  <div class="container-fluid">
    <h1 class="mt-4">Trainee Report</h1>
    <div class="card mb-4">
    <div class="card-body">
      View the report of the trainee during there session
    </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
          Trainee Report
      <a href="{{ url('/trainee')}}" class="btn btn-primary float-right" role="button"><i class="fas fa-step-backward"></i> BACK</a>
      </div>
      <br>
      <div class="card-body">
      	
      </div>
    </div>
  </div>
@endsection