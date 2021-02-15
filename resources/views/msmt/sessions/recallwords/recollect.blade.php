@extends('msmt.layouts.master')

@section('content')
<section>
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <h1 class="heading">RECALL WORDS</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 col-lg-offset-2 mx-auto text-justify">
       <p class="mx-auto">Now, try to remember as many of the <span class="emboss">CAPITALIZED</span> words from the story as you can. Use the story to help you remember the words.</p>
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
  <div class="row">
    <div class="col-lg-6 mx-auto">
      <form action="{{ url('cue') }}" method="POST" id="recallWords">
        @csrf {{ method_field('post') }}
        <div class="control-group">
          <div class="form-group floating-label-form-group controls mb-0 pb-2">
              <input class="form-control text-uppercase" id="jsRecallWord" name="words" type="text" placeholder="Recall Words" autocomplete="off">
          </div>
          <br/>
        </div>
        <div class="progress-container">
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" id="jsProgressBar"></div>
          </div>
          <div class="text-center text-dark">Total <span id="jsTotalWordCount">0</span>/{{$allWords}}</div>
          <br/>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 mx-auto" id="jsRecallWords">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 mx-auto">
      <div class="form-group"><button class="btn btn-primary btn-xl" id="jsSubmit" type="submit">SUBMIT</button></div>
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
        var typedWord = $('#jsRecallWord').val().toUpperCase().trim();
        if (typedWord != '') {
          words.push(typedWord);
          $("#jsRecallWords").html();
          recallWords();
        }
      } 
    });

    $("#jsSubmit").on('click touchstart', function(event) {
      event.preventDefault();
      if ( $('#jsRecallWord').val() != '') {
        words.push($('#jsRecallWord').val().toUpperCase().trim());
      }
      $(this).prop("disabled", true);
      // $(this).html(
      //   '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
      // );
      if ( confirm("Are you sure you wish to submit the form?") == true ) {
        $("#jsLoader").removeClass('d-none');
        $('#jsRecallWord').val(words.join(' '));
        var startTime = $("<input>").attr("name", "startTime").attr("type", "hidden").val(timer);
        $('#recallWords').append(startTime);
        var endTime = $("<input>").attr("name", "endTime").attr("type", "hidden").val(performance.now());
        $('#recallWords').append(endTime);
        $("#recallWords").submit();
      }
    });
    $(document).on('close.bs.alert', ".alert", function (event) {
      var removeWord = $(event.currentTarget).data('word');
      words.splice(words.indexOf(removeWord), 1);
      recallWords();
    });
    function recallWords() {
      var wordsHtml = '';
      var countOfUserWords = words.length;
      for (var count=0; count< countOfUserWords; count++) {
        var firstWord = words[count];
        wordsHtml += '<div class="row"><div class="col-lg-6 mx-auto"><div class="col alert alert-info alert-dismissible fade show" role="alert" data-word="'+firstWord+'"><strong>'+firstWord+'</strong> <button type="button" class="btn close" data-dismiss="alert" aria-label="Close" data-word="'+firstWord+'"><span aria-hidden="true" data-word="'+firstWord+'">×</span></button></div></div>';
        count++;
        if (typeof words[count] !== 'undefined') {
          var secondWord = words[count];
          wordsHtml += '<div class="col-lg-6 mx-auto"><div class="col alert alert-info alert-dismissible fade show" role="alert" data-word="'+secondWord+'"><strong>'+secondWord+'</strong> <button type="button" class="btn close" data-dismiss="alert" aria-label="Close" data-word="'+secondWord+'"><span aria-hidden="true" data-word="'+secondWord+'">×</span></button></div></div>';
        } else {
           wordsHtml += '<div class="col-lg-6 mx-auto">&nbsp;</div>';
        }
        wordsHtml += '</div>';
      }
      $("#jsRecallWords").html(wordsHtml);
      $('#jsRecallWord').val('');
      $('#jsTotalWordCount').text(countOfUserWords);
      var progressBarWidth = countOfUserWords * progressWidthIncrementor;
      $('#jsProgressBar').css('width', progressBarWidth+'%');
    }
  })
</script>
@endsection