@extends('layouts.master')

@section('content')
<main>
  <div class="container">
    <div class="row justify-content-center">
       <div class="col-lg-5">
         <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3>
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
            <label for="email" class="small mb-1">{{ __('Email') }}</label>
            <input class="form-control py-4 @error('email') is-invalid @enderror" name="email" id="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email address" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group">
            <label for="password" class="small mb-1">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control py-4 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
           
            </div>
            <div class="form-group">
            <div class="custom-control custom-checkbox">
             <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for="remember">{{ __('Remember Password') }}</label>
            </div>
            </div>
            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0 float-right">
                <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
            </div>
        </form>
      </div>
      <div class="card-footer text-center">
      <div class="small"><a href="{{url('register')}}">Need an account? Sign up!</a></div>
      </div>
    </div>
  </div>
</div>
</div>
</main>

@endsection
