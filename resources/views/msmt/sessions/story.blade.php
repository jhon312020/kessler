@extends('msmt.layouts.master')
@section('content')
      
 <!-- Main content -->
<section class="page-section" id="jsTraineeSession">
  <div class="container">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">START SESSION</h2>
    <!-- Icon Divider-->
    <div class="divider-custom">
      <div class="divider-custom-line"></div>
      <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
      <div class="divider-custom-line"></div>
    </div>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <p>On the same page below you are going to see a story. It will stay on the screen for a set period of time. Certain words in the story will be capitalized like THIS. Use this story to help you remember the capitalized words. Try to make a picture of each storyline in your head. Click on START when you are ready.</p>
          <br>
      </div>
    </div>
      <!-- Contact Section Form-->
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="form-group text-center">
          <button class="btn btn-primary btn-xl" id="jsStartSession" type="button">START</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>

<section class="page-section text-center d-none" id="jsTraineeStory">
  <div class="container">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Session Story</h2>
    <!-- Icon Divider-->
    <div class="divider-custom">
      <div class="divider-custom-line"></div>
      <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
      <div class="divider-custom-line"></div>
    </div>
    <!-- Contact Section Form-->
    <div class="row time-out" id="jsHide">
      <div class="col-lg-8 mx-auto">
         <div class="text-left">
          <div class="control-group">
           <div class="form-group controls mb-0 pb-2">
          <span id="timer">TIME REMAINING: 
            <span id="time">120</span>s</span>
            <button type="button" class="btn btn-link btn-xl" id="jsHideTimer">HIDE TIMER</button>
         </div>
        </div>
       </div>
     </div>
    </div>
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="control-group">
          <div class="form-group controls mb-0 pb-2" id="time-out">
            @if ($story)
            <p>{{ $story->story }}</p>
            @endif
          </div>
          <div class="row d-none" id="jsCue">
            <div class="col-lg-8 mx-auto">
              <div class="control-group">
                <div class="form-group controls mb-0 pb-2">
                  <p>Click on CONTINUE <br> to proceed with recall words</p>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group text-center">
            <a href="{{ url('recallwords')}}" class="btn btn-primary btn-xl">CONTINUE</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready( function() { 
    $(document).on('click', '#jsStartSession', function() {
      $('#jsTraineeSession').slideUp();
      $('#jsTraineeStory').removeClass('d-none').show();
      var counter = 120;
      var interval = setInterval(function() {
         counter--;
         // Display 'counter' wherever you want to display it.
         if (counter <= 0) {
             clearInterval(interval);
             $('#timer').html("<span>Times Up</span>");  
             return;
         }else{
           $('#time').text(counter);
           console.log("Timer --> " + counter);
         }
      }, 1000);
      setTimeout(function() {
      $('#time-out').fadeOut('fast');
      $('#jsCue').removeClass('d-none').show();
      $('#jsHide').hide();
      }, 120000); // <-- time in milliseconds
    });
    $('#jsStartSession').on('click', function(event) { 
        
    });
    // $(document).on('click', '#jsContinue', function(event) { 
    //   window.location.replace('/recallwords');
    // });
  })

$("#jsHideTimer").click(function(){
  $('#jsHide').hide();
});

 
</script>
{{-- </div> --}}
@endsection