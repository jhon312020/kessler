@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Story</h3></div>
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
            <form method="post" action="{{ route('story.update', $story->id) }}">
              @method('PATCH') 
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="type">Session Type</label>
                <select class="form-control select2" id="session_type" name="session_type" required placeholder="Select Session Type" readonly="true">
                  <option value= '' >Session Type</option>
                  @foreach($types as $type)
                    <option value="{{ $type->type }}" {{$story->session_type==$type->type?'selected':'' }}>{{ $type->type }}</option>
                  @endforeach;
                </select>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="session_number">Session Number</label>
                <select class="form-control select2" id="session_number" name="session_number" required placeholder="Select Session Number" readonly="true">
                  <option value= ''>Session Number</option>
                  @foreach($totalSessions as $session)
                    <option value="{{ $session }}" {{$session==$story->session_number?'selected':'' }}>{{ $session }}</option>
                  @endforeach;
                </select>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="story">Update Story</label>
                <textarea class="form-control py-4" name="story"  style="height: 218px;" rows="30" cols="150" placeholder="Enter Story ..." autofocus>{{$story->story}}</textarea>
              </div>
              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <button type="submit" class="btn btn-primary"><i class="fas fa-sync">&nbsp;</i> Update</button>
                <a href="{{ url('/story')}}" class="ml-2 btn btn-danger" role="button"><i class="fas fa-times">&nbsp;</i> Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection