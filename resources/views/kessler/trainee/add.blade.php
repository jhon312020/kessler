@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Add New Session</h3></div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="post" action="{{ route('trainee.store') }}" id="jsSubmitForm-{{ $trainee->id }}">
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="trainee_id">Trainee ID</label>
                <input type="text" class="form-control py-4" name="trainee_id" id="trainee_id" placeholder="Trainee ID" value="{{$trainee->trainee_id}}" readonly="true">
              </div>
             <div class="form-group" id="jsSessionType">
               <label class="small mb-1" for="session_number">Session Type</label>
              <select class="form-control select2" id="session_type" name="session_type" required placeholder="Select Session Type">
                <option value= '' selected="selected">Session Type</option>
                @foreach($types as $type)
                  <option value="{{ $type->type }}">{{ $type->type }}</option>
                @endforeach;
              </select>
            </div>
            <div class="form-group" id="jsSessionNumber">
              <label class="small mb-1" for="session_number">Session Number</label>
              <select class="form-control select2" id="session_number" name="session_number" required placeholder="Select Session Number">
                <option value='' selected="selected">Session Number</option>
                @foreach($totalSessions as $session)
                  <option value="{{ $session }}">{{ $session }}</option>
                @endforeach;
              </select>
            </div>
            <div class="form-group d-none" id="jsBooster">
               <label class="small mb-1" for="booster">Booster Session</label>
              <select class="form-control select2" id="booster_id" name="booster_id" placeholder="Select Booster Session">
                <option value= '' selected="selected">Booster Session</option>
                @foreach($booster as $booster)
                @if($type->type = 'A')
                  <option value="{{ $booster->id }}">{{ $booster->category }}</option>
                @endif
                @endforeach;
              </select>
            </div>
             <div class="form-group d-none" id="jsBoosterRange">
              <label class="small mb-1" for="booster_range">Booster Range</label>
              <select class="form-control select2" id="booster_range" name="booster_range" placeholder="Select Session Number">
                <option value='' selected="selected">Select Range</option>
                @foreach($boosterRange as $range)
                  <option value="{{ $range }}">{{ $range }}</option>
                @endforeach;
              </select>
            </div>
              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <button class="btn btn-primary jsConfirmButton" type="button" data-value="{{ $trainee->id }}">Add</button>
                <a href="{{ url('/trainee')}}" class="ml-2 btn btn-danger" role="button">Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready( function() { // Wait until document is fully parsed
  $('#jsSessionNumber, #jsSessionType').on('change', function() {
    if (($("#session_type option:selected").val() == "A") && (($("#session_number option:selected").val() == "9") || ($("#session_number option:selected").val() == "10"))) {
    $('#jsBooster').removeClass('d-none').show();
    $('#jsBoosterRange').removeClass('d-none').show();
     } else {
      $('#jsBooster').addClass('d-none');
      $('#jsBoosterRange').addClass('d-none');
     }
   });
  })
</script>
@include('common.confirm')
@endsection