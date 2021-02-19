@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Trainee</h3></div>
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
            <form method="post" action="{{ route('trainee.update', $trainee->id) }}" id="jsSubmitForm-{{ $trainee->id }}">
              @method('PATCH') 
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="trainee_id">Trainee ID</label>
                <input type="text" class="form-control py-4" name="trainee_id" id="trainee_id" placeholder="Trainee ID" value="{{$trainee->trainee_id}}" readonly="true">
              </div>
              {{-- <div class="form-group">
                <label class="small mb-1" for="type">Session Type</label>
                <select class="form-control select2" id="session_type" name="session_type" required placeholder="Select Session Type">
                  <option value= '' >Session Type</option>
                  @foreach($types as $type)
                    <option value="{{ $type->type }}" {{$trainee->session_type==$type->type?'selected':'' }}>{{ $type->type }}</option>
                  @endforeach;
                </select>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="session_number">Session Number</label>
                <select class="form-control select2" id="session_number" name="session_number" required placeholder="Select Session Number">
                  <option value= ''>Session Number</option>
                  @foreach($totalSessions as $session)
                    <option value="{{ $session }}" {{$session==$trainee->session_number?'selected':'' }}>{{ $session }}</option>
                  @endforeach;
                </select>
              </div> --}}
              <div class="form-group d-flex align-items-center float-left mt-4 mb-0">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="continue" name="state"  value="continue" {{ $trainee->session_state == 'continue'? 'checked':'' }}>
                  <label class="form-check-label" for="continue">Continue Session</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="scratch" name="state"  {{ $trainee->session_state == 'start'? 'checked':''}}  value="start" >
                  <label class="form-check-label" for="scratch">Start from Scratch</label>
                </div>
              </div>
              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <button class="btn btn-primary jsConfirmButton" type="button" data-value="{{ $trainee->id }}">Update</button>
                <a href="{{ url('/trainee')}}" class="ml-2 btn btn-danger" role="button">Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@include('common.confirm')
@endsection