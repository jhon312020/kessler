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
        View Details of Trainee Information  <a href="{{ route('trainee.create')}}" class="btn btn-primary btn-block bg-gradient-primary float-right add-tab" ><i class="fas fa-plus">&nbsp;</i> Add Trainee</a>
      </div>
      <div class="card-body">
        <div class="form-group">
          <!-- <label for="search">Search by Date and Trainee ID</label>
          <label for="search">Search by Date:</label>  -->
       {{--  <div class="form-row align-items-center">
          <div class="col-sm-3 my-1">
            <label class="sr-only" for="createdDate">Date</label>
            <input type="text" class="form-control" id="createdDate" name="createdDate" autocomplete="off" placeholder="Search By Date" value="{{ (isset($oldDate)) ? $oldDate : '' }}">
          </div>
        </div> --}}
      {{-- <form method="get" action="{{ url('/trainee') }}" id="jsSearchForm">
      @csrf
        <div class="form-group">
          <!-- <label for="search">Search by Date and Trainee ID</label> -->
          <label for="search">Search by Date</label>
        <div class="form-row align-items-center">
          <div class="col-sm-3 my-1">
            <label class="sr-only" for="createdDate">Date</label>
            <input type="text" class="form-control" id="createdDate" name="createdDate" autocomplete="off" placeholder="Date" value="{{ (isset($oldDate)) ? $oldDate : '' }}">
          </div>
           <div class="col-sm-3 my-1">
              <label class="sr-only" for="trainee_id">Trainee ID</label>
              <select class="form-control" id="trainee_id" name="trainee_id" autocomplete="off" placeholder="Trainee ID">
                <option value= '' selected="selected">Trainee ID</option>              @foreach($traineesOfTrainer as $trainee)
                 <option value="{{ $trainee->trainee_id }}" @if($trainee_id  == $trainee->trainee_id) selected="selected" @endif>{{ $trainee->trainee_id }}</option>
                @endforeach;
              </select>
          </div> 
          <input type="hidden" name="oldDate" id="oldDate" value="">
          <div class="col-auto my-1">
            <button type="submit" class="btn btn-primary" id="jsSearch">Submit</button>
          </div>
      </div>
      </div>
    </form> --}}  
    </div>
      <div class="card-body">
        <div class="table-responsive text-justify">
          <table class="table table-bordered" id="traineeDataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Trainee ID</th>
                <th>Session Pin</th>
                <th>Session Type</th>
                <th>Session Number</th>
                <th>Session Start Time</th>
                <th>Session End Time</th>
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
                <th>Session Start Time</th>
                <th>Session End Time</th>
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
                 @php
                   $sessionStartTime = isset($trainee->session_start_time)?json_decode($trainee->session_start_time): null;
                @endphp
                @if ($sessionStartTime) 
                <td>{{date('m/d/Y h:i a', strtotime($sessionStartTime->roundOne))}}</td>
                @else
                <td></td>
                @endif
                @php
                  $sessionEndTime = json_decode($trainee->session_end_time)
                @endphp
                @if ($sessionEndTime)
                <td>
                  @if($sessionEndTime->roundTwo)
                  {{date('m/d/Y h:i a', strtotime($sessionEndTime->roundTwo))}}
                  @elseif($sessionEndTime->roundOne)
                  {{date('m/d/Y h:i a', strtotime($sessionEndTime->roundOne))}}
                  @endif
                </td>
                @else
                <td></td>
                @endif 
                @if($trainee->completed === 1)
                <td>{{$trainee->session_state}}</td>
                @else
                <td>{{$trainee->session_state}}</td>
                @endif
                <td>
                   <a href="{{ route('trainee.add', $trainee->id)}}" class="btn btn-primary" role="button" title="Add"><i class="fas fa-plus" title="Add">&nbsp;</i></a>
                   @if ($trainee->completed == 0)
                  <a href="{{ route('trainee.edit', $trainee->id)}}" class="btn btn-primary" role="button" title="Edit"><i class="fas fa-edit" title="Edit">&nbsp;</i></a>
                   @endif
                  <a href="{{ url('trainee/view', $trainee->id)}}" class="btn btn-primary" role="button" title="View"><i class="fas fa-eye" title="View">&nbsp;</i> </a>
                  @if ($trainee->completed == 1)
                  <a href="{{ url('trainee/report', $trainee->id)}}" class="btn btn-primary" role="button" title="Report"><i class="fas fa-chart-pie" title="Report">&nbsp;</i> </a>
                  @endif 
                  @if (($trainee->session_number > 4 || strtolower($trainee->session_number) == 'booster') && $trainee->session_type == "A")
                    @php
                      $traineeCurrentPosition = json_decode($trainee->session_current_position)
                    @endphp
                    @if ($traineeCurrentPosition && $traineeCurrentPosition->position == 'review') 
                      <a href="{{ url('trainee/approve', $trainee->id)}}" class="btn btn-primary" role="button" title="Approve"><i class="fas fa-book" title="Approve">&nbsp;</i></a>
                    @endif
                  @endif
                  <form action="{{ route('trainee.destroy', $trainee->id)}}" method="post" class="d-inline" id="jsSubmitForm-{{ $trainee->id }}">
                    @csrf
                    @method('DELETE')
                    @if ($trainee->completed == 0)
                    <button class="btn btn-danger jsConfirmButton" type="button" data-value="{{ $trainee->id }}" title="Delete"><i class="fa fa-trash" title="Delete">&nbsp;</i> </button>         
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
var createdDate = '';
$(document).ready(function() {
 $("#createdDate").on('changeDate', function() {
    //$('#traineeDataTable').DataTable().ajax.reload();
  });
  $("#createdDate").datepicker({        
      //format: 'yyyy-mm-dd',
      //format: 'mm-dd-yyyy',
      dateFormat: 'mm-dd-yyyy',
      autoclose: true,
      todayHighlight: true,
  });
  //$('#traineeDataTable').DataTable({"ordering": false});
  $('#traineeDataTable').DataTable({
    "pageLength": 10, 
    "ordering": false,
    "processing": true,
    "serverSide": true,
    "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
    "ajax": {
      "url": "{{ route('trainee.getTrainee') }}",
      "data": function (d) {
        d.createdDate = $("#createdDate").val()
      }
    },
    columns: [
        { data: "trainee_id" },
        { data: "session_pin" },
        { data: "session_type" },
        { data: "session_number" },
        { data: "session_start_time" },
        { data: "session_end_time" },
        { data: "session_state" },
        { data: "action" },
    ]
  });     
});  
</script> 
@include('common.confirm')
@endsection