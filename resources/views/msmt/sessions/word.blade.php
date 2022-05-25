@extends('msmt.layouts.master')

@section('content')
<section id="jsTraineeSession">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="heading">INSTRUCTIONS</br></h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 mx-auto text-justify">
       {!! $instructions !!}
       <p>Click on <span class="emboss">START</span> when you are ready.</p>
       <br/>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 mx-auto">
       <div class="form-group text-center"><button class="btn btn-primary btn-xl" id="jsStartSession" type="submit">START</button></div>
    </div>
  </div>
</section>
<section class="page-section text-center d-none" id="jsTraineeStory">
  <div class="row">
    <div class="col-xs-12 col-lg-12">
      <h1 class="heading">Write Your Own Story</br></h1>
    </div>
  </div>
  @include('msmt.common.loader')
  <div class="row">
    <div class="col-lg-12 mx-auto" id="jsQueContainer">
      <form action="{{ url('read') }}" method="POST" id="jsFormWriteup">
      @csrf {{ method_field('post') }}
      <div class="row" id="jsWordContainer">
        <div class="col-xs-4 col-lg-12">
          <div class="row">
            @foreach($words as $wordGroup)
              <div class="col-xs-6 col-sm-6  <?php echo $respClass;?>">
                @foreach($wordGroup as $wordID=>$word)
                  <p id="jsWord-{{ $wordID }}" class="text-left">{{$word}}</p>
                @endforeach
              </div>
            @endforeach 
          </div>
        </div>
      </div>  
      <div class="row">  
        <div class="col-xs-4 col-lg-12 mx-auto">
          <textarea class="form-control writeup" id="jsWriteup" name="story" rows="15" placeholder="Enter Story ..." required  autofocus="on"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <div class="form-group text-center">
            <br/>
            <div class="alert d-none" role="alert" id="jsUserMessage"></div>
            <button class="btn btn-primary btn-xl" id="jsSubmit" type="submit">SUBMIT</button>
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready( function() { 
    var totalwords = "{{ $allWords }}";
    var allWords = '';
    var wordCount = totalwords.split(',').length;
    var userUsedWordCount = 0;
    var startOfWord = '';
    var endOfWord = '';
    var wordPosition = '';
    var checkKey = '';
    var writeup = '';
    var updateWriteUp = '';
    var matchingCombo = '';
    function findFirstPosition(writeUp, findWord, position = 0) {
      wordPosition = writeUp.indexOf(findWord);
      if (writeUp[wordPosition -1] == '' || writeUp[wordPosition -1] == ' ' ) {
        return position + wordPosition;
      } else {
        subStringLen = parseInt(wordPosition) + parseInt(findWord.length);
        writeUp = writeUp.slice(subStringLen);
        console.log('findFirstPosition',writeUp);
        console.log('findFirstPosition',writeUp.length);
        if (writeup.length > subStringLen) {
          return findFirstPosition(writeUp, findWord, subStringLen);
        } 
        return -1;
      }
    }
    $(document).on("keyup", "form", function(event) { 
      allWords = totalwords.split(',');
      $('#jsUserMessage').addClass('d-none');
      $('#jsWordContainer p').removeClass('strikeThrough');
      writeup = ' ' + $('#jsWriteup').val().toUpperCase();
      updateWriteUp = $('#jsWriteup').val();
      userUsedWordCount = 0;
      for (counter = 0; counter < wordCount; counter++) {
          matchingCombo = wordCombination = allWords[counter];
          wordPosition = writeup.indexOf(' '+wordCombination);
          // if (writeup.indexOf(wordCombination) > -1) {
          //   wordPosition = findFirstPosition(writeup, wordCombination);
          // }
          startWordCounter = parseInt(wordPosition);
          if (startWordCounter > 0) {
            startOfWord = writeup[wordPosition] ;
          } else {
            startOfWord = '';
          }
          if (wordPosition > -1) {
            if (wordPosition) {
               matchingCombo = ' ';
            } else {
              matchingCombo = '';
            }
            if (writeup.indexOf(wordCombination+'.') > -1) {
              wordPosition = writeup.indexOf(wordCombination+'.');
              matchingCombo += wordCombination+'.';
            } else if (writeup.indexOf(wordCombination+',') > -1) {
               wordPosition = writeup.indexOf(wordCombination+',');
               matchingCombo += wordCombination+',';
            } else if (writeup.indexOf(wordCombination+' ') > -1) {
               wordPosition = writeup.indexOf(wordCombination+' ');
               matchingCombo += wordCombination+' ';
            }
          }
          subStringLen = parseInt(wordPosition) + parseInt(wordCombination.length);
          endOfWord = writeup[subStringLen];
          if (wordPosition != -1) {
            subStringLen = parseInt(wordPosition) + parseInt(wordCombination.length);
            //For left user types lefthand in this case word left is getting matched so restting the substring
            if ((startOfWord == '' || startOfWord == ' ') && (endOfWord =='.' || endOfWord == ',' || endOfWord == ' ' || endOfWord == '') && typeof(endOfWord) !== 'undefined') {
              console.log('matchingCombo', matchingCombo);
              $('#jsWord-'+counter).addClass('strikeThrough');
              var regExp = new RegExp(matchingCombo,"i");
              updateWriteUp = updateWriteUp.replace(regExp, matchingCombo);
              userUsedWordCount++;
          } else {
            var regExp = new RegExp(allWords[counter],"gi");
            updateWriteUp = updateWriteUp.replace(regExp, allWords[counter].toLowerCase());
          }
        } 
      }
      $('#jsWriteup').val(updateWriteUp)
    });
    $(document).on('click touchstart', '#jsStartSession', function() {
      $('#jsTraineeSession').slideUp();
      $('#jsTraineeStory').removeClass('d-none').show();
    });
    $("#jsSubmit").on('click touchstart', function(event) {
      event.preventDefault();
      $('#jsUserMessage').addClass('d-none');
      $("#jsLoader").removeClass('d-none');
      $(this).prop("disabled", true);
      if (wordCount == userUsedWordCount) {
        $("#jsFormWriteup").submit();
      } else {
        $('#jsUserMessage').addClass('alert-danger');
        $('#jsUserMessage').text('Please use all the words to build the story!');
        $('#jsUserMessage').removeClass('d-none').show();
        $("#jsLoader").addClass('d-none');
        $('#jsWriteup').addClass('fill-ups-error');
        $('#jsWriteup').focus();
        $(this).prop("disabled", false);
      }
    })

  })
</script>
@endsection