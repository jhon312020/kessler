@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Trainee</h3></div>
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
          <form method="post" action="{{ route('trainee.store') }}">
            @csrf
            <div class="form-group">
              <label class="small mb-1" for="trainee_id">Trainee ID</label>
              <input type="text" class="form-control py-4" id="trainee_id" name="trainee_id" placeholder="Enter Trainee ID" required>
            </div>
            {{-- <div class="form-group" id="jsSessionType">
               <label class="small mb-1" for="session_number">Session Type</label>
              <select class="form-control select2" id="session_type" name="session_type" required placeholder="Select Session Type">
                <option value= '' selected="selected">Session Type</option>
                @foreach($types as $type)
                  <option value="{{ $type->type }}">{{ $type->type }}</option>
                @endforeach;
              </select>
            </div> --}}
            <div class="form-group" id="jsSessionNumber">
              <label class="small mb-1" for="session_number">Session Type</label>
              <select class="form-control select2" id="session_number" name="session_number" required placeholder="Select Session Type">
                <option value='' selected="selected">Session Type</option>
                @foreach($totalSessions as $session)
                  <option value="{{ $session }}">{{ $session }}</option>
                @endforeach;
              </select>
            </div>
          {{--  <div class="form-group d-none" id="jsFormType">
               <label class="small mb-1" for="type_id">Select Category</label>
              <select class="form-control select2" id="type_id" name="type_id" placeholder="Select Type">
                <option value= '' selected="selected">Select type</option>
                @foreach($formTypes as $formType)
                @if($type->type = 'A')
                  <option value="{{ $formType->id }}">{{ $formType->category }}</option>
                @endif
                @endforeach;
              </select>
            </div> --}}
            <div class="form-group d-none" id="jsBooster">
               <label class="small mb-1" for="booster_id">Select Category</label>
              <select class="form-control select2" id="booster_id" name="booster_id" placeholder="Select Category">
                <option value= '' selected="selected">Select Category</option>
                @foreach($booster as $booster)
                  <option value="{{ $booster->id }}">{{ $booster->category }}</option>
                @endforeach;
              </select>
            </div>
            <div class="form-group d-none" id="jsBoosterRange">
              <label class="small mb-1" for="booster_range">Select Form</label>
              <select class="form-control select2" id="booster_range" name="booster_range" placeholder="Select Form">
                <option value='' selected="selected">Select Form</option>
                @foreach($boosterRange as $range)
                  <option value="{{ $range }}">{{ $range }}</option>
                @endforeach;
              </select>
            </div>
            <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
              <button type="submit" class="btn btn-primary"><i class="fas fa-plus">&nbsp;</i> Add</button>
              <a href="{{ url('/trainee')}}" class="ml-2 btn btn-danger" role="button"><i class="fas fa-times">&nbsp;</i> Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready( function() { // Wait until document is fully parsed
  $('#jsSessionNumber').on('change', function() {
      resetSelect();
      var session_number = $("#session_number option:selected").val().toLowerCase();
      switch(session_number) {
        case 9:
        case 10:
        case '9':
        case '10':
          $('#booster_id').attr('required',true);
          $('#jsBooster').removeClass('d-none').show();
         
        break;
        case 'booster':
          $('#booster_id').attr('required',true);
          $('#booster_range').attr('required',true);
          $('#jsBooster').removeClass('d-none').show();
          $('#jsBoosterRange').removeClass('d-none').show();
        break;
      }
   });
    function resetSelect() {
      // $('#jsFormType').addClass('d-none');
      // $("#jsFormType option:selected").val('');
      $('#jsBooster').addClass('d-none');
      $('#jsBoosterRange').addClass('d-none'); 
      $('#booster_id').attr('required',false);
      $('#booster_range').attr('required',false);
      $("#booster_id option:first").prop('selected', true);
      $("#booster_range option:first").prop('selected', true);
    }
  })
</script>
@endsection
