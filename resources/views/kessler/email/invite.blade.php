@extends('msmt.layouts.master')
@section('content')
<section>
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="heading">Hi {{ $name }},<br>You are welcome to<br> Modified Story Memory Technique</h1>
      <h1 class="heading2">Your Username is</h1> {{ $email }}
      <h1 class="heading2">Your Password is</h1> {{ $password }}
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 mx-auto">
      <h3>Click <a href={{ route('/login') }}>here</a> to login into your account</h3>
    </div>
  </div>
</section>
@endsection
