@extends('msmt.layouts.master')

@section('content')
<section id="jsTraineeSession">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="heading">START SESSION</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
       <p class="mx-auto">On the same page below you are going to see a story. It will stay on the screen for a set period of time. Certain words in the story will be capitalized like THIS. Use this story to help you remember the capitalized words. Try to make a picture of each storyline in your head. Click on START when you are ready.</p>
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
      <h1 class="heading text-uppercase">Session Story</h1>
    </div>
  </div>
  <div class="row time-out" id="jsHide">
    <div class="col-lg-12 mx-auto">
      <div class="text-left">
        <div class="control-group">
          <div class="form-group controls mb-0 pb-2">
            <div id="accordion" class="accordion">
              <div class="card mb-0">
                <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne" style="border-bottom: none; background-color: white;">
                  <a class="card-title">COUNTDOWN TIMER</a>
                  <button type="button" class="close" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <span aria-hidden="true" class="float-right d-none" id="jsClose">&times;</span>
                    <span aria-hidden="true" class="float-right none" id="jsView">&minus;</span>
                  </button>
                </div>
                <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
                  <span id="timer">TIME REMAINING: 
                    <span id="time">120</span>s
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 mx-auto">
      <div class="control-group">
        <div class="form-group controls mb-0 pb-2" id="time-out">
          @if ($story)
          <p>{{ $story->updated_story }}</p>
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
          <a href="{{ url('recallword')}}" class="btn btn-primary btn-xl">CONTINUE</a>
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
</script>
{{-- </div> --}}
@endsection