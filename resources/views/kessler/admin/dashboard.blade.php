@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
         @if($kessler->role === "TA")
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                @if($traineeCount)
                <div class="card-body">No of Trainees :&emsp;{{$traineeCount}} 
                  <br>Session In Progress :&emsp;{{$traineeInProgressCount}} <br>Session Completed :&emsp;{{$traineeCompletedCount}}
                </div>
                @endif
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('/trainee')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        @endif
        @if($kessler->role === "SA") 
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                @if($kesslerTraineeCount)
                <div class="card-body">No of Trainees :&emsp;{{$kesslerTraineeCount}} 
                  <br>Sessions In Progress :&emsp;{{$kesslerInProgressCount}} <br>Sessions Completed :&emsp;{{$kesslerCompletedCount}}
                </div>
                @endif
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('/trainee')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        @endif
        @if($kessler->role === "SA") 
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                @if($trainerCount)
                <div class="card-body">No of Trainers :&emsp;{{$trainerCount}}
                <br>No of Active :&emsp;{{$trainerActiveCount}} <br>No of Inactive :&emsp;{{$trainerInActiveCount}}
                </div>
                @endif
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('/trainer')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        @endif
       <!--  <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Warning Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div> -->
<!--         <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Success Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div> -->
<!--         <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Danger Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection