@extends('msmt.layouts.master')

@section('content')
<section>
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="heading">CONGRATULATIONS </br></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
       <p class="text-center">You have successfully completed the {{ $round }} round of your session! Please contact your traineer!!!</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
       <a href="{{ url('/index') }}" class="btn btn-primary btn-xl" id="jsHome" type="submit">Home
                              </a>
    </div>
  </div>
</section>
@endsection