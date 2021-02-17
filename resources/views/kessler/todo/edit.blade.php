@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit To-Do</h3></div>
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
            <form method="post" action="{{ route('todo.update', $todo->id) }}">
              @method('PATCH') 
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="story_id">Session Number</label>
                <select class="form-control select2" id="story_id" name="story_id" required placeholder="Select Session Number">
                  <option value= ''>Session Number</option>
                  @foreach($totalSessions as $session)
                    <option value="{{ $session }}" {{$session==$todo->story_id?'selected':'' }}>{{ $session }}</option>
                  @endforeach;
                </select>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="todo">Update To-Do</label>
                <input type="text" class="form-control py-4" name="todo" id="todo" placeholder="Enter To-Do" value="{{$todo->todo}}">
              </div>
              <div class="form-group">
                <label class="small mb-1" for="categorical_cue">Update Categorical Cue</label>
                <input type="text" class="form-control py-4" name="categorical_cue" id="categorical_cue" placeholder="Enter Categorical Cue" value="{{$todo->categorical_cue}}">
              </div>             
              <div class="form-group d-flex align-todos-center float-right mt-4 mb-0">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('/todo')}}" class="ml-2 btn btn-danger" role="button">Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection