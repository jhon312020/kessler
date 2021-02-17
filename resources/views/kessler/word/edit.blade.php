@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Word</h3></div>
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
            <form method="post" action="{{ route('word.update', $word->id) }}">
              @method('PATCH') 
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="type">Session Type</label>
                <select class="form-control select2" id="session_type" name="session_type" required placeholder="Select Session Type">
                  <option value= '' >Session Type</option>
                  @foreach($types as $type)
                    <option value="{{ $type->type }}" {{$word->session_type==$type->type?'selected':'' }}>{{ $type->type }}</option>
                  @endforeach;
                </select>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="session_number">Session Number</label>
                <select class="form-control select2" id="session_number" name="session_number" required placeholder="Select Session Number">
                  <option value= ''>Session Number</option>
                  @foreach($totalSessions as $session)
                    <option value="{{ $session }}" {{$session==$word->story_id?'selected':'' }}>{{ $session }}</option>
                  @endforeach;
                </select>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="word">Update Word</label>
                <input type="text" class="form-control py-4" name="word" id="word" placeholder="Enter Word" value="{{$word->word}}">
              </div>
              <div class="form-group">
                <label class="small mb-1" for="contextual_cue">Update Contextual Cue</label>
                <input type="text" class="form-control py-4" name="contextual_cue" id="contextual_cue" placeholder="Enter Contextual Cue" value="{{$word->contextual_cue}}">
              </div>
              <div class="form-group">
                <label class="small mb-1" for="categorical_cue">Update Categorical Cue</label>
                <input type="text" class="form-control py-4" name="categorical_cue" id="categorical_cue" placeholder="Enter Categorical Cue" value="{{$word->categorical_cue}}">
              </div>             
              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('/word')}}" class="ml-2 btn btn-danger" role="button">Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection