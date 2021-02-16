@extends('msmt.layouts.master')

@section('content')
<section class="{{ $showTraineeMessage? '': 'd-none' }}" id="jsTraineeMessage">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <h1 class="heading">INSTRUCTIONS</br></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 mx-auto text-justify">
       <p class="mx-auto">Following the free recall, a contextual cue, and if necessary a categorical cue, is given to facilitate recall for each of the target words. After this is completed, the process is repeated with the same story</p>
       <br/>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 mx-auto">
       <div class="form-group text-center"><button class="btn btn-primary btn-xl" id="jsStartSession" type="submit">START</button></div>
    </div>
  </div>
</section>
<section class="text-center {{ !$showTraineeMessage? '': 'd-none' }}" id="jsQuestions">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <h1 class="heading">CUES</br></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="transparent-background d-none" id="jsLoader">
        <div class="loader-center">
          <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
      </div>
    </div>
  </div>
  <form action="{{ url('next') }}" method="POST" id="jsQuestionForm">
    <div class="row">
      <div class="col-lg-6 mx-auto text-justify" id="jsQueContainer">
        <div class="control-group">
          <div class="form-group controls mb-0 pb-2" class="answer_list">
            @csrf {{ method_field('post') }}
            <h1 class="m-0"></h1>
            <p id="question"> {!! $question !!}</p> <br/>   
          </div>   
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="alert d-none" role="alert" id="jsUserMessage"></div>
        <button type="button" id="jsNext" class="btn btn-primary btn-xl">CHECK</button>
      </div>
    </div>
  </form>
</section>
<script type="text/javascript">
  $(document).ready( function() { // Wait until document is fully parsed
    var showTraineeMessage = '{{ $showTraineeMessage }}';
    var timer = null;
    var requestInProcess = false;
    var categoryCueShowed = 0;
    var showedAnswer = 0;
    $('#answer').focus();
    //document.getElementById("answer").focus();
    if (!showTraineeMessage) {
      timer = performance.now();
    }
    $(document).on('keyup', '#answer', function() {
      //this.value = this.value.toUpperCase();
    });
    $(document).on("keydown", "form", function(event) { 
      confetti.remove();
      if (event.key == "Enter") {
        event.preventDefault();
        if (!requestInProcess) {
          $("#jsNext").trigger('click');
        }
        return false;
      } else {
        return event.key;
      }
    });
    //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $("#jsNext").on('click touchstart', function(event) {
      confetti.remove();
      $(this).prop("disabled", true);
      $("#jsQueContainer").slideDown();
      $("#jsLoader").removeClass('d-none');
      $("#jsNext").text("CHECK");
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
        $("#jsLoader").addClass('d-none');
        $('#answer').addClass('fill-ups-error');
        $('#answer').focus();
        document.getElementById("answer").focus();
        $(this).prop("disabled", false);
        return false;
      }
      requestInProcess = true;
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
          $("#jsNext").text("CHECK");
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
              document.getElementById("answer").focus();
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
              $("#jsNext").text("NEXT");
              $('#jsNext').focus();
              document.getElementById("jsNext").focus();
              $("#jsQueContainer").show("slow");
            } else {
              categoryCueShowed = 0;
              showedAnswer = 0;
              $("#jsNext").text("CHECK");
              $('#answer').focus();
              document.getElementById("answer").focus();
            }
           }
           requestInProcess = false;
        },
        error: function(xhr, textStatus, errorThrown) {
          $("#jsLoader").addClass('d-none');
          $('#jsUserMessage').addClass('alert-danger');
          $('#jsUserMessage').text('Please wait... Request is under process!');
          $('#jsUserMessage').removeClass('d-none').show();
          $("#jsNext").prop("disabled", false);
          requestInProcess = false;
        },
        dataType: 'json'
      });
    });

    $('#jsStartSession').on('click touchstart', function(event) { 
      $('#jsTraineeMessage').slideUp();
      $('#jsTraineeMessage').html('');
      $('#jsQuestions').removeClass('d-none').show();
      $('#answer').focus();
      document.getElementById("answer").focus();
      timer = performance.now();
    });
    function removeConfetti() {
      confetti.stop();
    }
  })
  
</script>
@endsection