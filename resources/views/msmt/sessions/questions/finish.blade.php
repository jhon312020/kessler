@extends('msmt.layouts.master')
@section('content')
<section>
  <div class="row">
    <div class="col-lg-6 mx-auto">
      <h1 class="heading">CONGRATULATIONS </br></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 mx-auto text-justify">
       <p>You have successfully completed the {{ $round }} round of your session! Please contact your trainer!!!</p>
       <br/>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 mx-auto">
       <a href="{{ url('/index') }}" class="btn btn-primary btn-xl" id="jsHome" type="submit">HOME</a>
    </div>
  </div>
</section>
@endsection