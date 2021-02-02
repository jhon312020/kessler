@extends('msmt.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
<!-- <link href="{{asset('css/app.css')}}" rel="stylesheet" /> -->
         <!-- Main content -->
<section class="page-section {{ $showTraineeMessage? '': 'd-none' }}" id="jsTraineeMessage">
  <div class="container">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">START CUES</h2>
    <!-- Icon Divider-->
    <div class="divider-custom">
      <div class="divider-custom-line"></div>
      <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
      <div class="divider-custom-line"></div>
    </div>
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <p>Following the free recall, a contextual cue, and if necessary a categorical cue, is given to facilitate recall for each of the target words. After this is completed, the process is repeated with the same story</p>
        <br>
      </div>
    </div>
    <!-- Contact Section Form-->
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="form-group text-center"><button class="btn btn-primary btn-xl" id="jsStartSession" type="submit">START</button></div>
      </div>
    </div>
  </div>
    <!-- /.container-fluid -->
</section>

<section class="page-section text-center {{ !$showTraineeMessage? '': 'd-none' }}" id="jsQuestions">
  <div class="container">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">CUES</h2>
    <!-- Icon Divider-->
    <div class="divider-custom">
      <div class="divider-custom-line"></div>
      <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
      <div class="divider-custom-line"></div>
    </div>
    <!-- Question Section-->
    <div class="row">
      <div class="transparent-background d-none" id="jsLoader">
        <div class="loader-center">
          <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
      </div>
      <div class="col-lg-8 mx-auto" id="jsQueContainer">
        <form action="{{ url('next') }}" method="POST" id="jsQuestionForm">
          <div class="control-group">
            <div class="form-group controls mb-0 pb-2" class="answer_list">
              @csrf {{ method_field('post') }}
              <h1 class="m-0"></h1>
              <p id="question"> {!! $question !!}</p>    
            </div>
            <div>
              <div class="alert d-none" role="alert" id="jsUserMessage"></div>
              <button type="button" id="jsNext" class="btn btn-primary btn-xl float-right">Check</button>
            </div>     
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
<script type="text/javascript">
  $(document).ready( function() { // Wait until document is fully parsed
    var showTraineeMessage = '{{ $showTraineeMessage }}';
    var timer = null;
    if (!showTraineeMessage) {
      timer = performance.now();
    }
    $(document).on('keyup', '#answer', function() {
      this.value = this.value.toUpperCase();
    });
    $(document).on("keydown", "form", function(event) { 
      confetti.remove();
      if (event.key == "Enter") {
        event.preventDefault();
        $("#jsNext").trigger('click');
        return false;
      } else {
        return event.key;
      }
    });

    var categoryCueShowed = 0;
    var showedAnswer = 0;
    //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $("#jsNext").on('click', function(event) {
      confetti.remove();
      $("#jsQueContainer").slideDown();
      $("#jsLoader").removeClass('d-none');
      $("#jsNext").text("Check");
      $(this).prop("disabled", true);

      // $(this).html(
      //   '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
      // );
      //confetti.remove();
      $('#jsUserMessage').text('');
      $('#jsUserMessage').removeClass().addClass('alert d-none');
      var answer = $('#answer').val();
      if (answer == '') {
        $('#jsUserMessage').addClass('alert-danger');
        $('#jsUserMessage').text('Please fill the blank!');
        $('#jsUserMessage').removeClass('d-none').show();
        $('#answer').addClass('fill-ups-error');
        $('#answer').focus();
        return false;
      }
      var form = $('#jsQuestionForm');
      var startTime = timer;
      var endTime = performance.now();
      var categoryCue = categoryCueShowed; 
      var formData = form.serialize()+ "&startTime=" + startTime+ "&endTime=" + endTime + "&categoryCue=" + categoryCue + "&showedAnswer=" + showedAnswer; 
      $.ajax({
        type: "POST",
        url: form.attr("action"),
        data: formData,
        success: function(response) {
          $("#jsQueContainer").slideDown();
          $("#jsNext").prop("disabled", false);
          $("#jsLoader").addClass('d-none');
          $("#jsNext").text("Check");
           if (response.completed) {
            //location.reload();
            console.log(response);
            window.location = response.redirectURL;
           } else if (response.reload) {
            console.log(response.reload);
           } else {
            console.log(response);
            timer = performance.now();
            $('#question').html(response.question);
            if (response.categorical_cue && !response.show_answer) {
              $('#jsUserMessage').addClass('alert-info');
              $('#jsUserMessage').html(response.categorical_cue);
              $('#jsUserMessage').removeClass('d-none');
              categoryCueShowed = 1;
              $('#answer').focus();
            } else if(response.show_answer) {
              categoryCueShowed = 0;
              showedAnswer = 1;
              $('#jsUserMessage').html(response.answer);
              if (response.is_answer_correct) {
                $('#jsUserMessage').addClass('alert-success');
                confetti.start();
                setTimeout(removeConfetti, 1000);
                $("#jsQueContainer").show("slow");
              } else {
                $('#jsUserMessage').addClass('alert-danger');
                $("#jsQueContainer").show("slow");
              }
              $('#jsUserMessage').removeClass('d-none');
              $("#jsNext").text("Next");
              $('#jsNext').focus();
              $("#jsQueContainer").show("slow");
            } else {
              categoryCueShowed = 0;
              showedAnswer = 0;
              $("#jsNext").text("Check");
              $('#answer').focus();
            }
            
           }
        },
        dataType: 'json'
      });
    });

    $('#jsStartSession').on('click', function(event) { 
      $('#jsTraineeMessage').slideUp();
      $('#jsTraineeMessage').html('');
      $('#jsQuestions').removeClass('d-none').show();
      $('#answer').focus();
      timer = performance.now();
    });
    function removeConfetti() {
      confetti.stop();
    }
  })
  
</script>
@endsection