@extends('msmt.layouts.master')

@section('content')
<section>
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="heading">Welcome to </br>Modified Story Memory Technique </br>Session</h1>
      <h1 class="heading2">To Begin Round 1</br>Enter Your Session Pin</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <form action="{{ url('/index') }}" method="POST">
        @csrf {{ method_field('post') }}
        <div class="control-group">
          <div class="form-group floating-label-form-group controls mb-0 pb-2">
            <label>Enter Session Pin</label>
            <input class="form-control" id="sessionpin" name="sessionpin" type="text" placeholder="Session Pin" autocomplete="off" />
            @error('sessionpin')
             <p class="help-block text-danger">{{$errors->first('sessionpin') }}</p>
            @enderror 
          </div>
        </div>
        <br />
        <div id="success"></div>
        <div class="form-group text-center"><button class="button btn btn-primary btn-xl" id="submit" type="submit">SUBMIT</button></div>
      </form>
    </div>
  </div>
</section>
@endsection
