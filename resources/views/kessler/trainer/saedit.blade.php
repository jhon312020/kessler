@extends('kessler.layouts.master')
@section('content')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/css/bootstrap-multiselect.css" integrity="sha512-Lif7u83tKvHWTPxL0amT2QbJoyvma0s9ubOlHpcodxRxpZo4iIGFw/lDWbPwSjNlnas2PsTrVTTcOoaVfb4kwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/style.css')}}" rel="stylesheet" />
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Trainer</h3></div>
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
            <form method="post" action="{{ route('trainer.update', $trainer->id) }}">
              @method('PATCH') 
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="name">Update name</label>
                <input type="text" class="form-control py-4" name="name" id="name" placeholder="Update name" value="{{$trainer->name}}">
              </div>
              <div class="form-group">
                <label class="small mb-1" for="email">Update email</label>
                <input type="text" class="form-control py-4" name="email" id="email" placeholder="Update email" value="{{$trainer->email}}">
              </div>   
              <div class="form-group">
                <label class="small mb-1" for="category">Update category</label>
                <select class="form-control select2" id="jsCategory" name="category[]" multiple="multiple">
                  @foreach($categories as $category)
                    @if(is_array($categoriesSelect) && in_array($category->name, $categoriesSelect))
                    <option selected="selected" value="{{ $category->id }}">{{ $category->name }}</option>
                    @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>        
            
              <div class="form-group session" id="jsStory">
              <label class="small mb-1" for="story">Story Sessions</label>
              <select class="form-control select2 " id="jsStorySel" name="story[]"  multiple="multiple">
                @foreach($storySession as $storyID)
                  @if(is_array($story[0]) && in_array($storyID, $story[0]))
                    <option selected="selected" value="{{ $storyID }}">{{ $storyID }}</option>
                  @else
                    <option value="{{ $storyID }}">{{ $storyID }}</option>
                  @endif
                @endforeach
              </select>
              </div>
            <div class="form-group session" id="jsContext">
              <label class="small mb-1 d-block" for="context_session">Contextual Sessions</label>
              <select class="form-control select2 category" id="jsContextSel" name="contextual[]" multiple="multiple">
                @foreach($writeSession as $writeID)
                  @if(is_array($contextual[0]) && in_array($writeID, $contextual[0]))
                    <option selected="selected" value="{{ $writeID }}">{{ $writeID }}</option>
                  @else
                    <option value="{{ $writeID }}">{{ $writeID }}</option>
                  @endif
                @endforeach
              </select>
             </div>
            
            
            <div class="form-group session" id="jsGeneral">
              <label class="small mb-1 d-block" for="general_session">General Sessions</label>
              <select class="form-control select2 category" id="jsGeneralSel" name="general[]" multiple="multiple" >
                @foreach($generalSession as $generalID)
                  @if(is_array($general[0]) && in_array($generalID, $general[0]))
                    <option selected="selected" value="{{ $generalID }}">{{ $generalID }}</option>
                  @else
                    <option value="{{ $generalID }}">{{ $generalID }}</option>
                  @endif
                @endforeach
              </select>
             </div>
            <div class="form-group session" id="jsBooster">
               <label class="small mb-1 d-block" for="booster">Booster Sessions</label>
              <select class="form-control select2 category" id="jsBoosterSel" name="booster[]" multiple="multiple">
                <!-- <option value= '' >Booster Sessions</option> -->
                @foreach($boosterSession as $booster)
                  @if(is_array($boosterSes) && in_array($booster->category, $boosterSes))
                    <option selected="selected" value="{{ $booster->id }}">{{ $booster->category }}</option>
                  @else
                    <option value="{{ $booster->id }}">{{ $booster->category }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            
            <div class="form-group session" id="jsOther">
              <label class="small mb-1 d-block" for="other_session">Control Sessions</label>
              <select class="form-control select2 category" id="jsOtherSel" name="other[]" multiple="multiple">
                @foreach($otherSession as $otherID)
                  @if(is_array($other[0]) && in_array($otherID, $other[0]))
                    <option selected="selected" value="{{ $otherID }}">{{ $otherID }}</option>
                  @else
                    <option value="{{ $otherID }}">{{ $otherID }}</option>
                  @endif
                @endforeach
              </select>
             </div>
            
              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <button type="submit" class="btn btn-primary"><i class="fas fa-sync">&nbsp;</i> Update</button>
                <a href="{{ url('/trainer')}}" class="ml-2 btn btn-danger" role="button"><i class="fas fa-times">&nbsp;</i> Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<!-- <script type="text/javascript" src="{{asset('js/multiselect.min.js')}}"></script>-->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.min.js" integrity="sha512-fp+kGodOXYBIPyIXInWgdH2vTMiOfbLC9YqwEHslkUxc8JLI7eBL2UQ8/HbB5YehvynU3gA3klc84rAQcTQvXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function() {
      resetSession();
      $('#jsCategory').multiselect({
        includeSelectAllOption: true,
      });
      $('#jsCategory').bind('change', function() {
        //window.location.reload();
        resetSession();
      });      
      
      $('#jsStorySel').multiselect({
        includeSelectAllOption: true,
      });
      $('#jsContextSel').multiselect({
        includeSelectAllOption: true,
      });
      $('#jsGeneralSel').multiselect({
        includeSelectAllOption: true,
      });
      $('#jsBoosterSel').multiselect({
        includeSelectAllOption: true,
      });
      $('#jsOtherSel').multiselect({
        includeSelectAllOption: true,
      });

      function resetSession() {
        var select = $("#jsCategory option:selected");
        var selected = $.map(select, function(option){
          return option.value;
        });
        const iterator = selected.values();
        $('.session').addClass('d-none');
        $('.session').find('select').attr('disabled', true);

        for (const value of iterator) {
          let containerID = '';
          switch(value) {
            //case story:
            case '1':
              containerID = '#jsStory';
            break;
            //case write:
            case '2':
              containerID = '#jsContext';
            break;
            //case general:
            case '3':
              containerID = '#jsGeneral';
            break;
            //case booster  
            case '4':
              containerID = '#jsBooster';
            break;
            //case other:
            case '5':
              containerID = '#jsOther';
            break;
          }
          enableMulSelButton(containerID);
        } 
      }
      function enableMulSelButton(containerID) {
        let elementID = containerID + 'Sel';
        $(containerID).removeClass('d-none');
        $(elementID).attr('required', true);
        $(elementID).attr('disabled', false);
        $(elementID).multiselect({
          includeSelectAllOption: true,
        });
        let $buttonObj = $(elementID).parent().find('button');
        $buttonObj.attr('disabled',false);
        $buttonObj.removeClass('disabled');
      }
      
  });
</script>
@endsection