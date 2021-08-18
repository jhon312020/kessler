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
       {{-- <p>Below you are going to see a list of 20 words. The words will be capitalized like <span class="emboss">THIS</span>. <p>Build a story of your own using these words. You can use multiple words in a sentence, but you want each sentence to be as easy to visualize as possible. The purpose of the story is to help you remember the capitalized words - you want to be able to create a picture of the storyline in your head.</p><p>Click on <span class="emboss">START</span> when you are ready.</p> --}}
      {!! $instructions !!}

       <p>Click on <span class="emboss">START</span> when you are ready. </p>
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
              <div class="col-xs-6 col-sm-6 <?php echo $respClass;?>">
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
            <button class="btn btn-primary btn-xl" id="jsReview" type="button">REVIEW</button>
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
    //console.log('TotalWords', totalwords);
    //console.log('sentenceWords', sentenceWords);
    sentenceWords = sentenceWords.split('**');
    //console.log('sentenceWords', sentenceWords);
    sentenceWordsLength = sentenceWords.length;
    var userUsedWordCount = 0;
    var wordCount = '';
    var writeUpWords = '';
    var subStringLen = 0;
    function review() { 
      allWords = totalwords.split(',');
      //console.log('allWords', allWords);
      writeUpWords = [];
      wordCount = allWords.length;
      $('#jsUserMessage').addClass('d-none');
      $('#jsWordContainer p').removeClass('strikeThrough');
      var writeup = $('#jsWriteup').val().toUpperCase();
      //var writeup = $('#jsWriteup').val();
      //var writeup = $('#jsWriteup').val();
      var updateWriteUp = $('#jsWriteup').val();
      var newWriteUp = '';
      userUsedWordCount = 0;
      //$('#jsWriteup').val(writeup.toUpperCase())
      var combinations = ['spaceanddot', 'spaceandcomma', 'spaceandspace', 'wordandspace'];
      var combLength = combinations.length;
      for (counter = 0; counter < wordCount; counter++) {
        // console.log('Write Start from loop', writeup);
        // console.log('Word:',allWords[counter]);
        var wordPostion = '';
        var checkKey = '';
        //for (combCounter = 0; combCounter < combLength; combCounter++  ) {
          wordCombination = allWords[counter];
          wordPostion = writeup.indexOf(wordCombination);
          subStringLen = parseInt(wordPostion) + parseInt(wordCombination.length);
          startWordCounter = parseInt(wordPostion);
          startOfWord = 0;
          if (startWordCounter > -1) {
            startOfWord = writeup[wordPostion - 1] ;
          }
          endOfWord = writeup[subStringLen];
          if (wordPostion != -1) {
            subStringLen = parseInt(wordPostion) + parseInt(wordCombination.length);
            //For left user types lefthand in this case word left is getting matched so restting the substring
            if ((startOfWord == '' || startOfWord == ' ') && (endOfWord =='.' || endOfWord == ',' || endOfWord ==' ' || endOfWord == '') && typeof(endOfWord) !== 'undefined') {
              //console.log('WordPostion', wordPostion);
              var regExp = new RegExp(allWords[counter],"i");
              updateWriteUp = updateWriteUp.replace(regExp, allWords[counter]);
              if (newWriteUp == '') {
                newWriteUp = updateWriteUp.substring(0, subStringLen);
              } else {
                newWriteUp = newWriteUp + updateWriteUp.substring(0, subStringLen);
              }
              writeup = writeup.substring(subStringLen, writeup.length);
              updateWriteUp = updateWriteUp.substring(subStringLen, updateWriteUp.length);
              //console.log('If writeup', writeup);
              //console.log('newwriteup', newWriteUp);
              userUsedWordCount++;
              writeUpWords.push(allWords[counter]); 
              delete allWords[counter];
          } else {
            if (newWriteUp == '') {
              newWriteUp = updateWriteUp.substring(0, subStringLen);
            } else {
              newWriteUp = newWriteUp + updateWriteUp.substring(0, subStringLen);
            }
            writeup = writeup.substring(subStringLen, writeup.length);
            updateWriteUp = updateWriteUp.substring(subStringLen, updateWriteUp.length);
            //console.log('Else writeup', writeup);
            counter--;
          }
        } 
        //console.log('New writeup',newWriteUp);
      }
      if (writeup != '') {
        newWriteUp = newWriteUp + updateWriteUp;
      }
      
      if (writeUpWords.length) {
        //console.log('writeUpWords-',writeUpWords);
        for(senCounter = 0; senCounter < sentenceWordsLength; senCounter++ ) {
          words = sentenceWords[senCounter].split(",");
          wordLength = words.length;
          var wordFound = false;
          for (subSenCounter = 0; subSenCounter < wordLength; subSenCounter++) {
            var findWord = words[subSenCounter];
            wordIndex = writeUpWords.indexOf(findWord);
            if (wordIndex !== -1) {
              wordFound = true;
              delete writeUpWords[wordIndex];
            } else {
              wordFound = false;
              break;
            }
          }
          if (wordFound == true) {
            $('#jsWord-'+senCounter).addClass('strikeThrough');
          }
        }
      }
      $('#jsWriteup').val(newWriteUp);
    }
    $(document).on('click touchstart', '#jsStartSession', function() {
      $('#jsTraineeSession').slideUp();
      $('#jsTraineeStory').removeClass('d-none').show();
    });
    $("#jsReview").on('click touchstart', function(event) {
      event.preventDefault();
      review();
      $('#jsUserMessage').addClass('d-none');
      $("#jsLoader").removeClass('d-none');
      $(this).prop("disabled", true);
      if (wordCount == userUsedWordCount) {
        $("#jsFormWriteup").submit();
      } else {
        console.log(wordCount, '==', userUsedWordCount);
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







