@extends('layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
          @csrf
            <div class="form-group">
              <label for="name" class="small mb-1">{{ __('Name') }}</label>
                 <input id="name" type="text" class="form-control py-4 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Enter Name" autofocus>
                 @error('name')
                   <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
                   </span>
                 @enderror
             </div>
             <div class="form-group">
               <label for="email" class="small mb-1">{{ __('Email') }}</label>
                   <input id="email" type="email" class="form-control py-4 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email address">
                     @error('email')
                       <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                       </span>
                     @enderror
               </div>
               <div class="form-group">
                  <label for="password" class="small mb-1">{{ __('Password') }}</label>
                      <input id="password" type="password" class="form-control py-4 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter password">
                       @error('password')
                         <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                   </div>
                   <div class="form-group">
                     <label for="password-confirm" class="small mb-1">{{ __('Confirm Password') }}</label>
                      <input id="password-confirm" type="password" class="form-control py-4" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                 </div>
                 <div class="form-group row mb-0">
                 <div class="col-md-6 offset-md-4">
                   <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
               </div>
             </div>
          </form>
        </div>
        <div class="card-footer text-center">
          <div class="small"><a href="{{url('/login')}}">Have an account? Go to login</a></div>
        </div>
     </div>
   </div>
 </div>
</div>
@endsection
