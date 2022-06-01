@extends('msmt.layouts.master')

@section('content')
<section class="text-center" id="jsQuestions">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <h1 class="heading">CUES<br/></h1>
    </div>
  </div>
  @include('msmt.common.loader')
  <form action="{{ $submitURL }}" method="POST" id="jsQuestionForm" onsubmit="return false">
    <div class="row">
      <div class="col-lg-8 mx-auto text-justify" id="jsQueContainer">
        <div class="control-group">
          <div class="form-group controls mb-0 pb-2" class="answer_list">
            @csrf {{ method_field('post') }}
            <h1 class="m-0"></h1>
            <p id="question" align= "center"> {!! $question !!}</p> <br/> 
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
    var timer = performance.now();;
    var requestInProcess = false;
    //var categoryCueShowed = 0;
    var showedAnswer = 0;
    $('#answer').focus();
    $(document).on("keydown", "form", function(event) { 
      var key;
      if (window.event)
        key = window.event.keyCode;
      else 
        key = event.which;
      if (key == 13) {
        event.preventDefault();
        if (!requestInProcess) {
          $("#jsNext").trigger('click');
        }
        return false;
      } else {
        return event.key;
      }
    });
    $("#jsNext").on('click touchstart', function(event) {
      $(this).prop("disabled", true);
      $("#jsQueContainer").slideDown();
      $("#jsLoader").removeClass('d-none');
      $("#jsNext").text("CHECK");
      $('#jsUserMessage').text('');
      $('#jsUserMessage').removeClass().addClass('alert d-none');
      var answer = $('#answer').val().toUpperCase();
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
      $('#answer').val(answer);
      var form = $('#jsQuestionForm');
      var startTime = timer;
      var endTime = performance.now();
      //var categoryCue = categoryCueShowed; 
      var formData = form.serialize()+ "&startTime=" + startTime+ "&endTime=" + endTime  + "&showedAnswer=" + showedAnswer; 
      $.ajax({
        type: "POST",
        url: form.attr("action"),
        data: formData,
        success: function(response) {
          console.log(response);
          $("#jsQueContainer").slideDown();
          $("#jsNext").prop("disabled", false);
          $("#jsLoader").addClass('d-none');
          $("#jsNext").text("CHECK");
           if (response.completed) {
            window.location = response.redirectURL;
           } else if (response.reload) {
            console.log(response.reload);
           } else {
            timer = performance.now();
            $('#question').html(response.question);
             if(response.show_answer) {
              showedAnswer = 1;
              $('#jsUserMessage').html(response.answer);
              //Control session logic if needed to check the validity of user answer
              /*if (response.is_answer_correct) {
                $('#jsUserMessage').addClass('alert-info');
                $("#jsQueContainer").show("slow");
              } else {
                $('#jsUserMessage').addClass('alert-info');
                $("#jsQueContainer").show("slow");
              }*/
              $('#jsUserMessage').addClass('alert-info');
              $("#jsQueContainer").show("slow");
              $('#jsUserMessage').removeClass('d-none');
              $("#jsNext").text("NEXT");
              $('#jsNext').focus();
              document.getElementById("jsNext").focus();
              $("#jsQueContainer").show("slow");
            } else {
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
  })
  
</script>
@endsection