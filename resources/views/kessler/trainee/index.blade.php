@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid">
    <h1 class="mt-4">Trainee Information</h1>
   <!--   <div class="card mb-4">
      <div class="card-body">
        Create, View and Edit Trainee Information
      </div>
    </div> -->
    <div class="card mb-4">
      <div class="card-header">
        <i class="fa fa-table mr-1"></i>
        Trainee Information  <a href="{{ route('trainee.create')}}" class="btn btn-primary btn-block bg-gradient-primary float-right" style="width: fit-content; margin-left: 25px;"><i class="fas fa-plus">&nbsp;</i> Add Trainee</a>
      </div>
      <div class="card-body">
      <form method="get" action="{{ url('/trainee') }}">
      @csrf
        <div class="form-group">
          <label for="search">Search by Date and Trainee ID</label>
        <div class="form-row align-items-center">
          <div class="col-sm-3 my-1">
            <label class="sr-only" for="date">Date</label>
            <input type="text" class="form-control" id="date" name="date" autocomplete="off" placeholder="From Date">
          </div>
          @if($user->role === "SA")
          <div class="col-sm-3 my-1">
              <label class="sr-only" for="trainee_id">Trainee ID</label>
              <select class="form-control" id="trainee_id" name="trainee_id" autocomplete="off" placeholder="Jane Doe">
                <option value= '' selected="selected">Trainee ID</option>              @foreach($uniqueKesslerTrainees as $trainee)
                <option value="{{ $trainee->trainee_id }}">{{ $trainee->trainee_id }}</option>
                @endforeach;
              </select>
          </div>
          @endif
          @if($user->role === "TA")
          <div class="col-sm-3 my-1">
              <label class="sr-only" for="trainee_id">Trainee ID</label>
              <select class="form-control" id="trainee_id" name="trainee_id" autocomplete="off" placeholder="Jane Doe">
                <option value= '' selected="selected">Trainee ID</option>              @foreach($uniqueTrainerTrainees as $trainee)
                <option value="{{ $trainee->trainee_id }}">{{ $trainee->trainee_id }}</option>
                @endforeach;
              </select>
          </div>
          @endif
          <div class="col-auto my-1">
            <button type="submit" class="btn btn-primary" id="jsSearch">Submit</button>
          </div>
      </div>
      </div>
    </form>   
    </div>
      <div class="card-body">
        <div class="table-responsive text-justify">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Trainee ID</th>
                <th>Session Pin</th>
                <th>Session Type</th>
                <th>Session Number</th>
                <!-- <th>Session Start Time</th>
                <th>Session End Time</th> -->
                <th>State</th>
                <th width="50%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Trainee ID</th>
                <th>Session Pin</th>
                <th>Session Type</th>
                <th>Session Number</th>
                <!-- <th>Session Start Time</th>
                <th>Session End Time</th> -->
                <th>State</th>
                <th width="50%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($trainees as $trainee)
              <tr>
                <td>{{$trainee->trainee_id}}</td>
                <td>{{$trainee->session_pin}}</td>
                <td>{{$trainee->session_type}}</td>
                <td>{{$trainee->session_number}}</td>
                {{-- <td>{{$trainee->session_start_time}}</td>
                <td>{{$trainee->session_end_time}}</td> --}}
                @if($trainee->completed === 1)
                <td>completed</td>
                @else
                <td>{{$trainee->session_state}}</td>
                @endif
                <td>
                   <a href="{{ route('trainee.add', $trainee->id)}}" class="btn btn-primary" role="button"><i class="fas fa-plus">&nbsp;</i> Add</a>
                   @if ($trainee->completed == 0)
                  <a href="{{ route('trainee.edit', $trainee->id)}}" class="btn btn-primary" role="button"><i class="fas fa-edit">&nbsp;</i> Edit</a>
                   @endif
                  <a href="{{ url('trainee/view', $trainee->id)}}" class="btn btn-primary" role="button"><i class="fas fa-eye">&nbsp;</i> View</a>
                  @if ($trainee->completed == 1)
                  <a href="{{ url('trainee/report', $trainee->id)}}" class="btn btn-primary" role="button"><i class="fas fa-chart-pie">&nbsp;</i> Report</a>
                  @endif 
                  @if ($trainee->session_number > 4 && $trainee->session_type == "A")
                    @php
                      $traineeCurrentPosition = json_decode($trainee->session_current_position)
                    @endphp
                    @if ($traineeCurrentPosition && $traineeCurrentPosition->position == 'review') 
                      <a href="{{ url('trainee/approve', $trainee->id)}}" class="btn btn-primary" role="button"><i class="fas fa-book">&nbsp;</i> Approve</a>
                    @endif
                  @endif
                  <form action="{{ route('trainee.destroy', $trainee->id)}}" method="post" class="d-inline" id="jsSubmitForm-{{ $trainee->id }}">
                    @csrf
                    @method('DELETE')
                    @if ($trainee->completed == 0)
                    <button class="btn btn-danger jsConfirmButton" type="button" data-value="{{ $trainee->id }}"><i class="fa fa-trash">&nbsp;</i> Delete</button>         
                    @endif
                  </form>
                </td>
              </tr>
               @endforeach
            </tbody>
          </table>
          <div>
            @if(session()->get('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}  
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
$(document).ready(function() {     
  $("#date").datepicker({        
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
  });     
});  
</script> 
@include('common.confirm')
@endsection