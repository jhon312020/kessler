@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
  <!-- Portfolio Section-->
  <section class="page-section portfolio" id="portfolio">
    <div class="container">
      <form id="contactForm" name="sentMessage" novalidate="novalidate">
        <div class="control-group">
          <div class="form-group floating-label-form-group controls mb-0 pb-2">
            <label>Enter Sesion Pin</label>
            <input class="form-control" id="sessionPin" type="text" placeholder="Enter Session Pin" required="required" data-validation-required-message="Please enter your session pin." name="sessionPin" />
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <br />
        <div id="success"></div>
        <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit">Submit</button></div>
      </form>
    </div>
  </section>
@endsection