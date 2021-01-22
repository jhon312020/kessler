@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Word</h3></div>
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
            <form method="post" action="{{ route('words.store') }}">
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="words">Enter Word</label>
                <input type="text" class="form-control py-4" id="words" name="words" placeholder="Enter Word" required>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="contextual_cue">Enter Contextual Cue</label>
                <input type="text" class="form-control py-4" id="contextual_cue" name="contextual_cue" placeholder="Enter Contextual Cue" required>
              </div>
                <div class="form-group">
                <label class="small mb-1" for="categorical_cue">Enter Categorical Cue</label>
                <input type="text" class="form-control py-4" id="categorical_cue" name="categorical_cue" placeholder="Enter Contextual Cue" required>
              </div>
              <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
