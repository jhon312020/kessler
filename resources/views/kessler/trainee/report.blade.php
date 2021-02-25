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
      	<div class="col-lg-6">
	        <div class="card mb-4">
	            <div class="card-header">
	                <i class="fas fa-chart-pie mr-1"></i>
	                Pie Chart Example
	            </div>
	            <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
	            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	        </div>
	    </div>
      </div>
    </div>
  </div>
@endsection