@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header"><h3 class="text-center font-weight-light my-4">View Trainee Story</h3></div>
        <div class="card-body">
          @if ($traineeStories->count() > 0)    
            @foreach($traineeStories as $traineeStory)       
              <div class="form-group">
                <label class="small mb-1" for="story">Round {{ $traineeStory->round }} </label>
                <textarea class="form-control py-4" name="story"  style="height: 218px;" rows="30" cols="150" placeholder="Enter Story ..." autofocus>{{ trim(strip_tags($traineeStory->updated_story)) }}</textarea>
              </div>
            @endforeach
          @else
             <div class="form-group"><h3 class="text-center font-weight-light my-4">No stories found</h3></div>
          @endif
            <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
              <a href="{{ url('/trainee')}}" class="ml-2 btn btn-primary" role="button">
                <i class="fas fa-caret-square-left">&nbsp;</i> Close
              </a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection