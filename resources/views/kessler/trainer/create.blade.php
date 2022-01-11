@extends('kessler.layouts.master')
@section('content')
<link href="{{asset('css/bootstrap-multiselect.css')}}" rel="stylesheet" />
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
                <input type="text" class="form-control py-4" id="name" name="name" placeholder="Enter name" required>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="email">Enter email address</label>
                <input type="email" class="form-control py-4" id="email" name="email" placeholder="Enter email address" required>
              </div>
              <div class="form-group" id="jsCategory">
                <label class="small mb-1" for="category">Category Type</label><br>
                <select class="form-control select2" id="category" name="category[]" multiple="multiple">
                @foreach($category as $categories)
                  <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                @endforeach;
                </select>
              </div>
              <div class="form-group d-none session" id="jsStory">
                <label class="small mb-1" for="story">Select story sessions</label>
                <select class="form-control select2" id="story" name="story[]" multiple="multiple">
                  
                  @foreach($storySession as $story)
                    <option value="{{ $story }}">{{ $story }}</option>
                  @endforeach;
                </select>
              </div>
              <div class="form-group d-none session" id="jsWrite">
                <label class="small mb-1" for="write">Select contextual sessions</label>
                <select class="form-control select2" id="write" name="contextual[]" multiple="multiple">
                  @foreach($writeSession as $write)
                    <option value="{{ $write }}">{{ $write }}</option>
                  @endforeach;
                </select>
              </div>
              <div class="form-group d-none session" id="jsGeneral">
                <label class="small mb-1" for="general">Select general sessions</label>
                <select class="form-control select2" id="general" name="general[]" multiple="multiple">
                  @foreach($generalSession as $general)
                    <option value="{{ $general }}">{{ $general }}</option>
                  @endforeach;
                </select>
              </div>
              <div class="form-group d-none session" id="jsBooster">
                <label class="small mb-1" for="booster">Select booster session</label>
                <select class="form-control select2" id="booster" name="booster[]" multiple="multiple">
                  @foreach($boosterSession as $booster)
                    <option value="{{ $booster->id }}">{{ $booster->category }}</option>
                  @endforeach;
                </select>
              </div>
           <!--    <div class="form-group">
                <label class="small mb-1" for="password">Enter Password</label>
                <input type="password" class="form-control py-4" id="password" name="password" placeholder="Enter Password" required>
              </div> -->
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
<script type="text/javascript" src="{{asset('js/bootstrap-multiselect.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {

      $('#category').multiselect();
      // location.reload();
      $('#jsCategory').click(function() {
      var select = $("#category option:selected");
      var selected = $.map(select, function(option){
        return option.value;
      });
      console.log(selected);
      const iterator = selected.values();
      $('.session').removeClass('d-none').hide();
      for (const value of iterator) {
      console.log(value);

      //var category_type = $("#jsCategory option:selected").val();
      
      //console.log(category_type);
      switch(value) {
        //case story:
        case '1':
          $('#story').attr('required',true);
          $('#jsStory').removeClass('d-none').show();  
          break;

        //case write:
        case '2':
          $('#write').attr('required',true);
          $('#jsWrite').removeClass('d-none').show();
          break;

        //case general:
        case '3':
          $('#general').attr('required',true);
          $('#jsGeneral').removeClass('d-none').show();
           
          break;
        case '4':
          $('#booster').attr('required',true);
          $('#jsBooster').removeClass('d-none').show();
          
          break;
      }
    }  
    });
    /*document.getElementsByClassName('multiselect').onclick = function() {
      var select = document.getElementsByClassName('active');
      var selected = [...select.selectedOptions]
                      .map(option => option.value);
      console.log(selected);*/ 
    /*document.getElementsByClassName('multiselect').onclick = function() {
      var select = document.getElementsByClassName('active');
      var selected = [...select.selectedOptions]
                      .map(option => option.value);
      console.log(selected);
    } */

/*      $('#jsCategory').on('change', function() {
      

      var category_type = $("#category option:selected").val();
      
      console.log(category_type);
         
      switch(category_type) {
        //case story:
        case '1':
          $('#story').attr('required',true);
          $('#jsStory').removeClass('d-none').show();
          break;
        
        //case write:
        case '2':
          $('#write').attr('required',true);
          $('#jsWrite').removeClass('d-none').show();
          break;

        //case general:
        case '3':
          $('#general').attr('required',true);
          $('#jsGeneral').removeClass('d-none').show();
           
          break;
        case '4':
          $('#booster').attr('required',true);
          $('#jsBooster').removeClass('d-none').show();
          
          break;
      }
    
    });
*/      
  });
</script>


@endsection
