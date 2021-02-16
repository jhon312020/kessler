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
            <form method="post" action="{{ route('trainee.update', $trainee->id) }}">
              @method('PATCH') 
              @csrf
              <div class="form-group">
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
              </div>
              <div class="form-group d-flex align-items-center float-left mt-4 mb-0">
              <input type="radio" name="state" id="jsLeft" class="jsLeft" value="continue" checked="checked">
              &emsp;Continue Session&emsp;
              <input type="radio" name="state" id="jsScratch" class="jsScratch" value="start">&emsp;Start from Scratch&emsp;
              </div>
              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <button type="button" id="jsUpdate" class="btn btn-primary">Update</button>
                <a href="{{ url('/trainee')}}" class="ml-2 btn btn-danger" role="button">Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   $(document).ready( function() { // Wait until document is fully parsed
    $("#jsUpdate").on('click touchstart', function(event) {
      event.preventDefault();
      if (confirm("Are you sure to continue ?") == true ) {
           window.location.href = "/trainee";
      }
    });
   })
</script>
@endsection