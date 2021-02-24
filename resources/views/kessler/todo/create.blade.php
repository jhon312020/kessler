@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Add To-Do</h3></div>
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
            <form method="post" action="{{ route('todo.store') }}">
              @csrf
              <div class="form-group">
               <label class="small mb-1" for="booster_range">Booster Range</label>
              <select class="form-control select2" id="booster_range" name="booster_range" required placeholder="Select Booster Range">
                <option value= '' selected="selected">Booster Range</option>
                @foreach($boosterRange as $range)
                  <option value="{{ $range }}">{{ $range }}</option>
                @endforeach;
              </select>
             </div>
              <div class="form-group">
                <label class="small mb-1" for="todo">Enter To-Do</label>
                <input type="text" class="form-control py-4" id="todo" name="todo" placeholder="Enter To-Do" required>
              </div>
                <div class="form-group">
                <label class="small mb-1" for="categorical_cue">Enter Categorical Cue</label>
                <input type="text" class="form-control py-4" id="categorical_cue" name="categorical_cue" placeholder="Enter Categorical Cue" required>
              </div>
              <div class="form-group d-flex align-todos-center float-right mt-4 mb-0">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus">&nbsp;</i> Add</button>
                <a href="{{ url('/todo')}}" class="ml-2 btn btn-danger" role="button"><i class="fas fa-times">&nbsp;</i> Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
