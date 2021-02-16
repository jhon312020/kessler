@extends('msmt.layouts.master')

@section('content')
<section id="jsTraineeSession">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="heading">INSTRUCTIONS</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-offset-2 col-lg-8 mx-auto text-justify">
       <p class="mx-auto">On the same page below you are going to see a story. It will stay on the screen for a set period of time. Certain words in the story will be capitalized like <span class="emboss">THIS</span>. </p><p>Use this story to help you remember the capitalized words. Try to make a picture of each storyline in your head.</p><p> Click on <span class="emboss">START</span> when you are ready.</p>
       <br/>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
       <div class="form-group text-center"><button class="btn btn-primary btn-xl" id="jsStartSession" type="submit">START</button></div>
    </div>
  </div>
</section>
<section class="text-center d-none" id="jsTraineeStory">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="heading text-uppercase">Session # {{$trainee['session_number']}} </h1>
    </div>
  </div>
  <div class="row hide-time">
    <div class="col-lg-10 mx-auto"><a href="#" id="jsHide">Hide Time</a></div>
  </div>
  <div class="row mb-3" id="jsTimeContainer">
    <div class="col-lg-10 mx-auto timer">
      <div class="text-center emboss">
        Time Remaining: <span id="time">120</span>s
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-10 mx-auto text-justify px-4">
      <div class="control-group">
        <div class="form-group controls mb-0 pb-2" id="time-out">
          @if ($story)
          <p>{!! $story->story !!}</p>
          @endif
        </div>
        <div class="row d-none" id="jsCue">
          <div class="col-lg-8 mx-auto text-center">
            <p>Click on <span class="emboss">CONTINUE</span> <br> to proceed with recall words</p>
            <br/>
          </div>
        </div>
        <div class="form-group text-center">
          <a href="{{ $linkURL }}" class="btn btn-primary btn-xl">CONTINUE</a>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready( function() { 
    $(document).on('click touchstart', '#jsStartSession', function() {
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
        } else {
          $('#time').text(counter);
          console.log("Timer --> " + counter);
        }
      }, 1000);
      setTimeout(function() {
        $('#time-out').fadeOut('fast');
        $('#jsCue').removeClass('d-none').show();
        $('#jsHide').addClass('d-none');
        $('#jsTimeContainer').addClass('d-none');
      }, 120000); // <-- time in milliseconds
    });

    $(document).on('click touchstart', '#jsHide', function() {
      $('#jsTimeContainer').toggleClass('d-none');
      if ($(this).text() == "Hide Time") {
        $(this).text("Show Time");
      } else {
        $(this).text("Hide Time");
      }
      return false;
    });

    $('#jsStartSession').on('click touchstart', function(event) { 
        
    });
    // $(document).on('click', '#jsContinue', function(event) { 
    //   window.location.replace('/recallwords');
    // });
  })
</script>
{{-- </div> --}}
@endsection