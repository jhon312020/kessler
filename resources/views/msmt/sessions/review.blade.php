@extends('msmt.layouts.master')

@section('content')
<section>
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="heading">Review</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 mx-auto text-justify">
      <p class="help-block pb-3">Great! You have now submitted your story.</p>
      <p class="help-block pb-3">Please wait for your trainer to review the story and allow you to proceed with the next steps.</p>
      <p class="help-block pb-3">You can use the <span class="emboss">REFRESH</span> button below after few minutes to check if your story is ready for the next steps.</p>
      <div class="form-group text-center"><button class="button btn btn-primary btn-xl" id="jsReloadPage" type="button">Refresh</button></div>
      </form>
    </div>
  </div>
</section>
<script type="text/javascript">
  $(document).ready( function() {
    $(document).on('click touchstart', '#jsReloadPage', function() {      
      window.location.reload();
    });
  });
</script>
@endsection