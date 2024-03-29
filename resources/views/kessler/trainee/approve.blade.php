@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Approve Story</h3></div>
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
            <form method="post" action="{{url('/trainee/approve/'.$traineeStory->id)}}">
              @method('POST') 
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="story">Approve Story</label>
                <textarea class="form-control py-4" name="story"  style="height: 218px;" rows="30" cols="150" placeholder="Enter Story ..." autofocus>{{$traineeStory->original_story}}</textarea>
              </div>
              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <button type="submit" class="btn btn-primary"><i class="fas fa-thumbs-up">&nbsp;</i> Approve</button>
                <a href="{{ url('/trainee')}}" class="ml-2 btn btn-danger" role="button"><i class="fas fa-times">&nbsp;</i> Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection