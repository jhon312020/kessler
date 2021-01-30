@extends('msmt.layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
   <section class="page-section">
        <div class="container">
          <!-- Contact Section Heading-->
          <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">TO BEGIN YOUR SESSION<br>ENTER YOUR SESSION PIN</h2>
          <!-- Icon Divider-->
          <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
          </div>
          <!-- Contact Section Form-->
          <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
              <form action="{{ url('/') }}" method="POST">
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
                <div class="form-group"><button class="btn btn-primary btn-xl" id="submit" type="submit">SUBMIT</button></div>
              </form>
            </div>
          </div>
        </div>
      </section>
  </div>
@endsection
