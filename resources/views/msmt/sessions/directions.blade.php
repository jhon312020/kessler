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
      {{--  <p>Below you are going to see a list of 20 words. The words will be capitalized like <span class="emboss">THIS</span>. <p>Build a story of your own using these words. You can use multiple words in a sentence, but you want each sentence to be as easy to visualize as possible. The purpose of the story is to help you remember the capitalized words - you want to be able to create a picture of the storyline in your head.</p><p>Click on <span class="emboss">START</span> when you are ready. </p> --}}
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
              <div class="col-xs-12 col-sm-12 <?php echo $respClass;?>">
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
    var sentenceWords = "{{ $sentenceWords }}";
    
    sentenceWords = sentenceWords.split('**');
    sentenceWordsLength = sentenceWords.length;
    var userUsedWordCount = 0;
    var wordCount = totalwords.split(',').length;
    var writeUpWords = '';
    var subStringLen = 0;
    var writeup = '';
    var updateWriteUp = '';
    var newWriteUp = '';
    var wordPostion = '';
    var checkKey = '';
    var startOfWord = '';
    var endOfWord = '';
    var wordPosition = '';
    var regExp = '';
    var findWord = '';
    var matchingCombo = '';
    let singleSpace = ' ';
    var wordFound = false;
    //var combinations = ['spaceanddot', 'spaceandcomma', 'spaceandspace', 'wordandspace'];
    //var combLength = combinations.length;
    $(document).on("keyup", "form", function(event) { 
      allWords = totalwords.split(',');
      writeUpWords = [];
      wordCount = allWords.length;
      $('#jsUserMessage').addClass('d-none');
      $('#jsWordContainer p').removeClass('strikeThrough');
      writeup = $('#jsWriteup').val().toUpperCase();
      updateWriteUp = $('#jsWriteup').val();
      newWriteUp = '';
      regExp = '';
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
                console.log(wordPosition);
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
            //console.log('Start', startOfWord, 'endOfWord', endOfWord);
            //For left user types lefthand in this case word left is getting matched so restting the substring
            if ((startOfWord == '' || startOfWord == ' ') && (endOfWord =='.' || endOfWord == ',' || endOfWord == ' ' || endOfWord == '') && typeof(endOfWord) !== 'undefined') {
              // console.log("updateWriteUp", updateWriteUp);
              console.log('matchingCombo', matchingCombo, 'wordPosition',wordPosition);
              //$('#jsWord-'+counter).addClass('strikeThrough');
              var regExp = new RegExp(matchingCombo,"i");
              updateWriteUp = updateWriteUp.replace(regExp, replaceCombo);
              userUsedWordCount++;
              writeUpWords.push(allWords[counter]); 
              delete allWords[counter];
          } else {
            var regExp = new RegExp(allWords[counter],"gi");
            updateWriteUp = updateWriteUp.replace(regExp, allWords[counter].toLowerCase());
            counter--;
            //console.log(updateWriteUp);
          }
        }
      }
      if (writeUpWords.length) {
        for(senCounter = 0; senCounter < sentenceWordsLength; senCounter++ ) {
          words = sentenceWords[senCounter].split(",");
          wordLength = words.length;
          wordFound = false;
          findWord = '';

          for (subSenCounter = 0; subSenCounter < wordLength; subSenCounter++) {
            findWord = words[subSenCounter];
            wordIndex = writeUpWords.indexOf(findWord);
            console.log('word', wordIndex);
            if (wordIndex !== -1) {
              wordFound = true;
              delete writeUpWords[wordIndex];
            } else {
              wordFound = false;
              break;
            }
          }
          if (wordFound == true ) {
            $('#jsWord-'+senCounter).addClass('strikeThrough');
            //$('#jsWriteup').toUpperCase();
            //totalwords.map(f =>{ return f.toUpperCase(); });
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







