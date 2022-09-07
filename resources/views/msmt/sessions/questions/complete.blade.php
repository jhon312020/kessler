@extends('msmt.layouts.master')
@section('content')
<section>
  <div class="row">
    <div class="col-lg-6 mx-auto">
      <h1 class="heading">CONGRATULATIONS! </br></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 mx-auto text-justify">
       <p>You have successfully completed the {{ $round }} round of this session.
       <p>Please contact your trainer for further instructions.</p>
       <br/>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 mx-auto">
      <br/>
      {{-- <a href="{{ url('/index') }}" class="btn btn-primary btn-xl" id="jsHome" type="submit" role="button">HOME</a> --}}
      <button onClick="window.location.href = '{{ $homeURL }}'" class="btn btn-primary btn-xl" id="jsHome" type="button" role="button">HOME</button>
    </div>
  </div>
</section>
@endsection