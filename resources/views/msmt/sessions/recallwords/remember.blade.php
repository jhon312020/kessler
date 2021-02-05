@extends('msmt.layouts.master')

@section('content')
<section>
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="heading">RECALL WORDS</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
       <p class="mx-auto">Now, try to remember as many of the CAPITALIZED words from the story as you can. Use the story to help you remember the words.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" id="jsRecallWords">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 text-center">
      <div class="transparent-background d-none" id="jsLoader">
        <div class="loader-center">
          <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 text-center">
      <form action="{{ url('sessions') }}" method="POST" id="recallWords">
        @csrf {{ method_field('post') }}
        <div class="control-group">
          <div class="form-group floating-label-form-group controls mb-0 pb-2">
            <label>RECALL WORDS</label>
              <input class="form-control" id="jsRecallWord" name="words" type="text" placeholder="Recall Words" autocomplete="off">
          </div>
          <br/>
        </div>
        <div class="progress-container">
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" id="jsProgressBar"></div>
          </div>
          <div class="text-center text-dark">Total <span id="jsTotalWordCount">0</span>/{{$allWords}}</div>
        </div>
        <div class="form-group"><button class="btn btn-primary btn-xl" id="jsSubmit" type="submit">SUBMIT</button></div>
      </form>
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready( function() { // Wait until document is fully parsed
    
    var timer = performance.now();
    var words = new Array();
    var allWords = {{ $allWords }};
    const totalPercentage = 100;
    const progressWidthIncrementor = totalPercentage / allWords; 
    $(document).on('keypress', '#jsRecallWord', function(event) {
      if (event.keyCode == 13) {
        return false;
      }
    });
   $(document).on('keyup', '#jsRecallWord', function(event) {
      if (event.keyCode == 32 || event.keyCode == 13) {
        var typedWord = $('#jsRecallWord').val();
        words.push(typedWord.trim());
        $("#jsRecallWords").append('<div style="display: inline; line-height:3.5em; margin: 5px" class="col alert alert-info alert-dismissible fade show" role="alert" data-word="'+typedWord+'"><strong>'+typedWord+'</strong> <button type="button" class="btn close" data-dismiss="alert" aria-label="Close" data-word="'+typedWord+'"><span aria-hidden="true" data-word="'+typedWord+'">×</span></button></div>');
        $('#jsRecallWord').val('');
        var countOfUserWords = words.length;
        console.log(countOfUserWords);
        $('#jsTotalWordCount').text(countOfUserWords);
        var progressBarWidth = countOfUserWords * progressWidthIncrementor;
        $('#jsProgressBar').css('width', progressBarWidth+'%');
      } else {
        this.value = this.value.toUpperCase();
      }
    });

    $("#jsSubmit").on('click', function(event) {
      if ( $('#jsRecallWord').val() != '') {
        words.push($('#jsRecallWord').val());
      }
      $(this).prop("disabled", true);
      $(this).html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
      );
      event.preventDefault();
      $("#jsLoader").removeClass('d-none');
      $('#jsRecallWord').val(words.join(' '));
      var startTime = $("<input>").attr("name", "startTime").attr("type", "hidden").val(timer);
      $('#recallWords').append(startTime);
      var endTime = $("<input>").attr("name", "endTime").attr("type", "hidden").val(performance.now());
      $('#recallWords').append(endTime);
      $("#recallWords").submit();
    });
    $(document).on('close.bs.alert', ".alert", function (event) {
      var removeWord = $(event.currentTarget).data('word');
      words.splice(words.indexOf(removeWord), 1);
    });
  })
     
  
</script>
@endsection