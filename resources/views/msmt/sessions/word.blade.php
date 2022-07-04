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
    let singleSpace = ' ';
    function findFirstPosition(writeUp, findWord, position = 0) {
      wordPosition = writeUp.indexOf(findWord);
      if (writeUp[wordPosition -1] == '' || writeUp[wordPosition -1] == ' ' ) {
        return position + wordPosition;
      } else {
        subStringLen = parseInt(wordPosition) + parseInt(findWord.length);
        writeUp = writeUp.slice(subStringLen);
        console.log('findFirstPosition',writeUp);
        console.log('findFirstPosition',writeUp.length);
        console.log('subStringLen',subStringLen);
        if (writeup.length >= subStringLen) {
          return findFirstPosition(writeUp, findWord, subStringLen);
        } 
        return position;
      }
    }
    $(document).on("keyup", "form", function(event) { 
      allWords = totalwords.split(',');
      $('#jsUserMessage').addClass('d-none');
      $('#jsWordContainer p').removeClass('strikeThrough');
      writeup = $('#jsWriteup').val().toUpperCase();
      updateWriteUp = $('#jsWriteup').val();
      userUsedWordCount = 0;
      for (counter = 0; counter < wordCount; counter++) {
          matchingWord = wordCombination = allWords[counter];
         // wordPosition = writeup.indexOf(' '+wordCombination);
         //Matching the pattern if it is the start of the sentence
          pattern = `\\b(${matchingWord})[\\s\\,\\.]`;
          pattern = new RegExp(pattern);
          result = pattern.exec(writeup);
          startOfWord = '';
          if (result) {
            wordPosition = result.index;
            subStringLen = parseInt(wordPosition) + parseInt(wordCombination.length);
            if (wordPosition != 0) {
              //Changing the pattern if it is not the start of the sentence
              pattern = `\(\\s)(${matchingWord})[\\s\\,\\.]`;
              pattern = new RegExp(pattern);
              result = pattern.exec(writeup);
              if (result) {
                wordPosition = result.index;
                startOfWord = writeup[wordPosition];
                subStringLen = parseInt(wordPosition) + parseInt(wordCombination.length);
                subStringLen += 1; 
              } else {
                wordPosition = -1;
              }
            }
            endOfWord = writeup[subStringLen];
          } else  {
            wordPosition = -1;
          }
          if (wordPosition > -1) {          
            updatePosition = updateWriteUp.indexOf(wordCombination);
            if (wordPosition == 0) {
              if (writeup.indexOf(wordCombination+'.') == wordPosition) {
                matchingCombo = wordCombination+'\\.';
                replaceCombo =  wordCombination+'.';
              } else if (writeup.indexOf(wordCombination+',') == wordPosition) {
                matchingCombo = wordCombination+',';
                replaceCombo =  wordCombination+',';
              } else if (writeup.indexOf(wordCombination+' ') == wordPosition) {
                matchingCombo = wordCombination+singleSpace;
                replaceCombo =  wordCombination+singleSpace;
              }
            } else {
              if (writeup.indexOf(singleSpace+wordCombination+'.') == wordPosition) {
                matchingCombo = singleSpace+wordCombination+'\\.';
                replaceCombo =  singleSpace+wordCombination+'.';
              } else if (writeup.indexOf(singleSpace+wordCombination+',') == wordPosition) {
                matchingCombo = singleSpace+wordCombination+',';
                replaceCombo =  singleSpace+wordCombination+',';
              } else if (writeup.indexOf(singleSpace+wordCombination+singleSpace) == wordPosition) {
                matchingCombo = singleSpace+wordCombination+singleSpace;
                replaceCombo =  singleSpace+wordCombination+singleSpace;
              }
            }
          }
          if (wordPosition != -1) {
            //subStringLen = parseInt(wordPosition) + parseInt(wordCombination.length);
            console.log('Start', startOfWord, 'endOfWord', endOfWord);
            //For left user types lefthand in this case word left is getting matched so restting the substring
            if ((startOfWord == '' || startOfWord == ' ') && (endOfWord =='.' || endOfWord == ',' || endOfWord == ' ' || endOfWord == '') && typeof(endOfWord) !== 'undefined') {
              // console.log("updateWriteUp", updateWriteUp);
              console.log('matchingCombo', matchingCombo, 'wordPosition',wordPosition);
              $('#jsWord-'+counter).addClass('strikeThrough');
              var regExp = new RegExp(matchingCombo,"i");
              updateWriteUp = updateWriteUp.replace(regExp, replaceCombo);
              userUsedWordCount++;
          } else {
            var regExp = new RegExp(allWords[counter],"gi");
            updateWriteUp = updateWriteUp.replace(regExp, allWords[counter].toLowerCase());
            //console.log(updateWriteUp);
          }
        }
      }
      $('#jsWriteup').val(updateWriteUp);
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
      //console.log('wordCount', wordCount);
      //console.log('userUsedWordCount', userUsedWordCount);
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
    });
  });
</script>
@endsection