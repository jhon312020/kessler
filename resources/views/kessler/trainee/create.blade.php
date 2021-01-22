@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Trainee</h3></div>
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
            <form method="post" action="{{ route('trainee.store') }}">
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="trainee_id">Trainee ID</label>
                <input type="text" class="form-control py-4" id="trainee_id" name="trainee_id" placeholder="Enter Trainee ID" required>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="session_type">Session Type</label>
                <input type="text" class="form-control py-4" id="session_type" name="session_type" placeholder="Enter Session Type" required>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="session_number">Session Number</label>
                <select class="form-control select2" id="session_number" name="session_number" required placeholder="Select Session Number">
                  <option selected="selected">Session Number</option>
                  @foreach($totalSessions as $session)
                    <option value="{{ $session }}">{{ $session }}</option>
                  @endforeach;
                </select>
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
