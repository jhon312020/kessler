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
             {{-- <div class="form-group" id="jsSessionType">
               <label class="small mb-1" for="session_type">Session Type</label>
              <select class="form-control select2" id="session_type" name="session_type" required placeholder="Select Session Type">
                <option value= '' selected="selected">Session Type</option>
                @foreach($types as $type)
                  <option value="{{ $type->type }}">{{ $type->type }}</option>
                @endforeach;
              </select>
            </div> --}}
            {{--- <div class="form-group" id="jsSessionNumber">
              <label class="small mb-1" for="session_number">Session Type</label>
              <select class="form-control select2" id="session_number" name="session_number" required placeholder="Select Session Type">
                <option value='' selected="selected">Session Type</option>
                @foreach($totalSessions as $session)
                  <option value="{{ $session }}">{{ $session }}</option>
                @endforeach;
              </select>
            </div>
             <div class="form-group d-none" id="jsBooster">
               <label class="small mb-1" for="booster_id">Select Category</label>
              <select class="form-control select2" id="booster_id" name="booster_id" placeholder="Select Category" >
                <option value= '' selected="selected">Select Category</option>
                @foreach($booster as $booster)
                  <option value="{{ $booster->id }}">{{ $booster->category }}</option>
                @endforeach;
              </select>
            </div>
            <div class="form-group d-none" id="jsBoosterRange">
              <label class="small mb-1" for="booster_range">Select Form</label>
              <select class="form-control select2" id="booster_range" name="booster_range" placeholder="Select Form" >
                <option value='' selected="selected">Select Form</option>
                @foreach($boosterRange as $range)
                  <option value="{{ $range }}">{{ $range }}</option>
                @endforeach;
              </select>
            </div>---}}
            <div class="form-group" id="jsCategory">
              <label class="small mb-1" for="category_type">Category Type</label>
              <select class="form-control select2" id="category_type" name="session_type"  placeholder="Select Category Type">
                <option value='' selected="selected">Category Type</option>
                
                @foreach($categories as $id => $name)
                  <option value="{{ $id }}">{{ $name }}</option>
                @endforeach;
              
              </select>
            </div>
            
            @if(is_array($story[0]) && count($story[0])>0)
            <div class="form-group d-none session" id="jsStory">
              <label class="small mb-1" for="session_number">Story Sessions</label>
              <select class="form-control select2 category" id="story_session" name="session_number"  placeholder="Select Story Session" disabled = "true">
                <option value='' selected="selected">Story Sessions</option>
                
                @foreach($story[0] as $story)
                  <option value="{{ $story }}">{{ $story }}</option>
                @endforeach;
              
              </select>
            </div>
            @endif
            @if(is_array($contextual[0]) && count($contextual[0]) > 0)
            <div class="form-group d-none session" id="jsContext">
              <label class="small mb-1" for="context_session">Contextual Sessions</label>
              <select class="form-control select2 category" id="context_session" name="session_number"  placeholder="Select Contextual Session" disabled = "true">
                <option value='' selected="selected">Contextual Sessions</option>
                
                @foreach($contextual[0] as $contextual)
                  <option value="{{ $contextual }}">{{ $contextual }}</option>
                @endforeach;
              
              </select>
             </div>
            @endif

            @if(is_array($other[0]) && count($other[0]) > 0)
            <div class="form-group d-none session" id="jsOther">
              <label class="small mb-1" for="other_session">Contol Sessions</label>
              <select class="form-control select2 category" id="other_session" name="session_number"  placeholder="Select Control Session" disabled = "true">
                <option value='' selected="selected">Control Sessions</option>
                
                @foreach($other[0] as $other)
                  <option value="{{ $other }}">{{ $other }}</option>
                @endforeach;
              
              </select>
             </div>
            @endif
            
            <div class="form-group d-none session" id="jsBooster">
               <label class="small mb-1" for="booster_id">Select Category</label>
              <select class="form-control select2" id="booster_id1" name="booster_id" placeholder="Select Category" disabled="true">
                <option value= '' selected="selected">Select Category</option>
                @foreach($boosters as $booster)
                  <option value="{{ $booster->id }}">{{ $booster->category}}</option>
                @endforeach;
              </select>
            </div>
            
            
            @if(is_array($general[0]) && count($general[0]) > 0)
            <div class="form-group d-none session" id="jsGeneral">
              <label class="small mb-1" for="general_session">General Sessions</label>
              <select class="form-control select2 category" id="general_session" name="session_number"  placeholder="Select General Session" disabled = "true">
                <option value='' selected="selected">General Sessions</option>
                
                @foreach($general[0] as $general)
                  <option value="{{ $general }}">{{ $general }}</option>
                @endforeach;
              
              </select>
             </div>
            @endif
            
            <div class="form-group d-none " id="jsBoosterSes">
              <label class="small mb-1" for="booster_session">Booster Sessions</label>
              <select class="form-control select2 category" id="booster_session" name="session_number"  placeholder="Select Booster Session" disabled = "true">
              <option value="{{$boosterSession}}" selected="selected">Booster </option>
              </select>
            </div>
            
            <div class="form-group d-none session" id="jsBoosterID">
               <label class="small mb-1" for="booster_id">Select Category</label>
              <select class="form-control select2" id="booster_id" name="booster_id" placeholder="Select Category" disabled="true">
                <option value= '' selected="selected">Select Category</option>
                @foreach($boosters as $booster)
                  <option value="{{ $booster->id }}">{{ $booster->category}}</option>
                @endforeach;
              </select>
            </div>
            
            <div class="form-group d-none session" id="jsBoosterRange">
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
  $('#jsCategory').on('change',function(){
    var category = $("#category_type option:selected").val().toLowerCase();
    console.log('Category',category);
    resetSelect();
    $('.session').removeClass('d-none').hide();
    //$('.category').attr('disabled',true);
    switch(category){
      case '1': 
        $('#story_session').attr('disabled',false);      
        $('#story_session').attr('required',true);
        $('#jsStory').removeClass('d-none').show();
      break;

      case '2':
        $('#context_session').attr('disabled',false);
        $('#context_session').attr('required',true);
        $('#jsContext').removeClass('d-none').show();
      break;

      case '3':
        $('#general_session').attr('disabled',false);
        $('#general_session').attr('required',true);
        $('#jsGeneral').removeClass('d-none').show();
        $('#booster_id1').attr('disabled',false);
        $('#booster_id1').attr('required',true);
        $('#jsBooster').removeClass('d-none').show();
      break;

      case '4':
        $('#booster_session').attr('disabled',false);
        //$('#booster_session').attr('required',true);
        $('#jsBoosterID').removeClass('d-none').show();
        //$('#jsBoosterSes').removeClass('d-none').show();
        $('#booster_id').attr('disabled',false);
        $('#booster_id').attr('required',true);
        $('#booster_range').attr('required',true);
        //$('#jsBooster').removeClass('d-none').show();
        $('#jsBoosterRange').removeClass('d-none').show();
      break;

      case '5':
        $('#other_session').attr('disabled',false);
        $('#other_session').attr('required',true);
        $('#jsOther').removeClass('d-none').show();
      break;
    }
  });
  
  function resetSelect() {
    let allSessions = $("[id$='_session']");
    for(session of allSessions) {
      //console.log(session);
      //console.log(session.disabled);
      session.disabled = true;      
      session.required = false;
    }
    // $('#jsFormType').addClass('d-none');
    // $("#jsFormType option:selected").val('');

    $('#jsBooster').addClass('d-none');
    $('#jsBoosterRange').addClass('d-none'); 
    $('#booster_id').attr('required',false);
    $('#booster_id').attr('disabled',true);
    $('#booster_id1').attr('required',false);
    $('#booster_id1').attr('disabled',true);
    $('#booster_range').attr('required',false);
    $("#booster_id option:first").prop('selected', true);
    $("#booster_id1 option:first").prop('selected', true);
    $("#booster_range option:first").prop('selected', true);
    $("#general_session option:first").prop('selected', true);
  }
  });
/*$(document).ready( function() { // Wait until document is fully parsed
  $('#jsSessionNumber').on('change', function() {
      resetSelect();
      var session_number = $("#session_number option:selected").val().toLowerCase();
      switch(session_number) {
        case 17:
        case 18:
        case '17':
        case '18':
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
      $("#booster_id option:first").prop('selected', true);
      $("#booster_range option:first").prop('selected', true);
    }
  })*/
</script>
@endsection