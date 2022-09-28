@extends('kessler.layouts.master')
@section('content')
<!-- <link href="{{asset('css/bootstrap-multiselect.css')}}" rel="stylesheet" /> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/css/bootstrap-multiselect.css" integrity="sha512-Lif7u83tKvHWTPxL0amT2QbJoyvma0s9ubOlHpcodxRxpZo4iIGFw/lDWbPwSjNlnas2PsTrVTTcOoaVfb4kwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/style.css')}}" rel="stylesheet" />
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Trainer</h3></div>
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
            <form method="post" action="{{ route('trainer.store') }}">
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="name">Enter Name</label>
                <input type="text" class="form-control py-4" id="name" name="name" placeholder="Enter name" value="{{old('name')}}" required>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="email">Enter email address</label>
                <input type="email" class="form-control py-4" id="email" name="email" placeholder="Enter email address" value="{{old('email')}}" required>
              </div>
              <div class="form-group" >
                <label class="small mb-1" for="category">Session Type</label><br>
                <select class="form-control py-4" id="jsCategory" name="category[]" multiple="multiple">
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
                </select>
              </div>
              
              <div class="form-group d-none session" id="jsStory">
                <label class="small mb-1 d-block" for="story">Story sessions</label>
                <select class="form-control select2" id="jsStoryIn" name="story[]" multiple="multiple" >
                  @foreach($storySession as $story)
                    <option value="{{ $story }}">{{ $story }}</option>
                  @endforeach
                </select>
              </div>
              
              <div class="form-group d-none session" id="jsWrite">
                <label class="small mb-1 d-block" for="write">Contextual sessions</label>
                <select class="form-control select2" id="jsWriteIn" name="contextual[]" multiple="multiple">
                 <!--  <option value= '' selected="selected">Select Contextual Session</option> -->
                  @foreach($writeSession as $write)
                    <option value="{{ $write }}">{{ $write }}</option>
                  @endforeach
                </select>
              </div>
                           
              <div class="form-group d-none session" id="jsGeneral">
                <label class="small mb-1 d-block" for="general">General sessions</label>
                <select class="form-control select2" id="jsGeneralIn" name="general[]" multiple="multiple">
                  <!-- <option value= '' selected="selected">Select General Session</option> -->
                  @foreach($generalSession as $general)
                    <option value="{{ $general }}">{{ $general }}</option>
                  @endforeach
                </select>
              </div>
              
              <div class="form-group d-none session" id="jsBooster">
                <label class="small mb-1 d-block" for="booster">Booster sessions</label>
                <select class="form-control select2" id="jsBoosterIn" name="booster[]" multiple="multiple">
                  <!-- <option value= '' selected="selected">Select Booster Session</option> -->
                  @foreach($boosterSession as $booster)
                  @if($booster->type == 'Booster')
                    <option value="{{ $booster->id }}" >{{ $booster->category }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              
              <div class="form-group d-none session" id="jsOther">
                <label class="small mb-1 d-block" for="other">Control sessions</label>
                <select class="form-control select2" id="jsOtherIn" name="other[]" multiple="multiple">
                  @foreach($otherSession as $other)
                    <option value="{{ $other }}">{{ $other }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus">&nbsp;</i> Add</button>
                <a href="{{ url('/trainer')}}" class="ml-2 btn btn-danger" role="button"><i class="fas fa-times">&nbsp;</i> Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<!-- <script type="text/javascript" src="{{asset('js/bootstrap-multiselect.js')}}"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.min.js" integrity="sha512-fp+kGodOXYBIPyIXInWgdH2vTMiOfbLC9YqwEHslkUxc8JLI7eBL2UQ8/HbB5YehvynU3gA3klc84rAQcTQvXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script type="text/javascript" src="{{asset('js/multiselect.min.js')}}"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
      $('#jsCategory').multiselect({
        includeSelectAllOption: true,
      });
      
      $('#jsCategory').bind('change',function() {
      var select = $("#jsCategory option:selected");
      var selected = $.map(select, function(option){
        return option.value;
      });
      const iterator = selected.values();
      $('.session').addClass('d-none');
      $('.session').find('select').attr('disabled',true);
      for (const value of iterator) {
      switch(value) {
        //case story:
        case '1':
          $('#jsStoryIn').attr('required',true);
          $('#jsStory').removeClass('d-none'); 
          $('#jsStoryIn').attr('disabled',false); 
          $('#jsStoryIn').multiselect({
            includeSelectAllOption: true,
          });
        break;

        //case write:
        case '2':
          $('#jsWriteIn').attr('required',true);
          $('#jsWrite').removeClass('d-none');
          $('#jsWriteIn').attr('disabled',false);
          $('#jsWriteIn').multiselect({
            includeSelectAllOption: true,
          });
        break;

        //case general:
        case '3':
          $('#jsGeneralIn').attr('required',true);
          $('#jsGeneral').removeClass('d-none');
          $('#jsGeneralIn').attr('disabled',false);
          $('#jsGeneralIn').multiselect({
            includeSelectAllOption: true,
          });
        break;

        //case booster  
        case '4':
          $('#jsBoosterIn').attr('required',true);
          $('#jsBooster').removeClass('d-none');
          $('#jsBoosterIn').attr('disabled',false);
          $('#jsBoosterIn').multiselect({
            includeSelectAllOption: true,
          });
        break;

        //case other:
        case '5':
          $('#jsOtherIn').attr('required',true);
          $('#jsOther').removeClass('d-none');
          $('#jsOtherIn').attr('disabled',false);
          $('#jsOtherIn').multiselect({
            includeSelectAllOption: true,
          });
        break;
      }
    }  
    });
  });
</script>

@endsection
