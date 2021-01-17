@extends('msmt.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <section class="page-section">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">RECALL WORDS</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                <p>Now, try to remember as many of the CAPITALIZED words from the story as you can<br> Use the story to help you remember the words</p>
                <br>
                </div>
              </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{{ $message }}</strong>
                </div>
                <br>
                @endif
                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                        <form action="{{ url('sessions') }}" method="POST" id="recallWords">
                         @csrf {{ method_field('post') }}
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>RECALL WORDS</label>
                                    <input class="form-control" id="words" name="words" type="text" placeholder="Recall Words"/>
                                </div>
                            </div>
                            <br />
                            <div id="success"></div>
                            <div class="form-group"><button class="btn btn-primary btn-xl" id="jsSubmit" type="submit">SUBMIT</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
  </div>
<script type="text/javascript">
  $(document).ready( function() { // Wait until document is fully parsed
    var timer = performance.now();
    $("#jsSubmit").on('click', function(event) {
      event.preventDefault();
      var startTime = $("<input>").attr("name", "startTime").attr("type", "hidden").val(timer);
      $('#recallWords').append(startTime);
      var endTime = $("<input>").attr("name", "endTime").attr("type", "hidden").val(performance.now());
      $('#recallWords').append(endTime);
      $("#recallWords").submit();
    });
  })
</script>
@endsection