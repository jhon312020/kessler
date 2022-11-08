@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Approve Story</h3></div>
          <div class="card-body">
          @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif            
            <form method="post" id="jsFormWriteup" action="{{url('/trainee/approve/'.$traineeStory->id)}}">
              @method('POST') 
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="story">Approve Story</label>
                <textarea class="form-control py-4" name="story" id="jsWriteup" style="height: 218px;" rows="30" cols="150" placeholder="Enter Story ..." autofocus>{{$traineeStory->updated_story}}</textarea>
              </div>
              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <!-- <a onclick='viewModal(this)' id = 'jsview' class='btn btn-primary' role='button' title='View'><i class='fas fa-eye' title='View'></i> View </a>&nbsp; -->
                <button type="submit" id="jsSubmit" class="btn btn-primary"><i class="fas fa-thumbs-up">&nbsp;</i> Approve</button>
                <a href="{{ url('/trainee')}}" class="ml-2 btn btn-danger" role="button"><i class="fas fa-times">&nbsp;</i> Cancel</a>
              </div>
              <div class="row">
                <div class="col-lg-8 mx-auto">
                <div class="form-group text-center">
                <br/>
                <div class="alert d-none" role="alert" id="jsUserMessage"></div>
                </div>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- @include('common.wordmodal') -->
<script type="text/javascript">
  $(document).ready( function() { 
    var totalwords = "{{ $allWords }}";
    var sentenceWords = "{{ $sentenceWords }}";
    
    sentenceWords = sentenceWords.split('**');
    
    sentenceWordsLength = sentenceWords.length;
    var userUsedWordCount = 0;
    var wordCount = totalwords.split(',').length;
    var word = totalwords.split(',');
    console.log('word', word);
    var writeUpWords = '';
    var subStringLen = 0;
    var writeup = '';
    var updateWriteUp = '';
    var newWriteUp = '';
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
      //$('#jsWordContainer p').removeClass('strikeThrough');
      writeup = $('#jsWriteup').val().toUpperCase();
      updateWriteUp = $('#jsWriteup').val();
      newWriteUp = '';
      regExp = '';
      userUsedWordCount = 0;
      for (counter = 0; counter < wordCount; counter++) {
        wordPosition = '';
        checkKey = '';
        matchingCombo = wordCombination = allWords[counter];
        wordPosition = writeup.indexOf(wordCombination);
        subStringLen = parseInt(wordPosition) + parseInt(wordCombination.length);
        startWordCounter = parseInt(wordPosition);
        startOfWord = '';

          if (startWordCounter > 0) {
            startOfWord = writeup[wordPosition -1];
          } 
          if (wordPosition > -1) {
            if (wordPosition) {
               matchingCombo = ' ';
               replaceCombo = ' ';
            } else {
              matchingCombo = '';
              replaceCombo = '';
            }
            
            if (writeup.indexOf(wordCombination+',') == wordPosition) {
              wordPosition = writeup.indexOf(wordCombination+',');
              matchingCombo += wordCombination+',';
              replaceCombo +=  wordCombination+',';
            } else if (writeup.indexOf(wordCombination+' ') == wordPosition) {
              wordPosition = writeup.indexOf(wordCombination+' ');
              matchingCombo += wordCombination+' ';
              replaceCombo +=  wordCombination+' ';  
            } else if (writeup.indexOf(wordCombination+'.') == wordPosition) {  
              wordPosition = writeup.indexOf(wordCombination+'.');
              matchingCombo += wordCombination+'\\.';
              replaceCombo +=  wordCombination+'.';
            }
          }
          subStringLen = parseInt(wordPosition) + parseInt(wordCombination.length);

        endOfWord = writeup[subStringLen];
        if (wordPosition != -1) {
          subStringLen = parseInt(wordPosition) + parseInt(wordCombination.length);
          //For left user types lefthand in this case word left is getting matched so restting the substring
          if ((startOfWord == '' || startOfWord == ' ') && (endOfWord =='.' || endOfWord == ',' || endOfWord ==' ' || endOfWord == '') && typeof(endOfWord) !== 'undefined') {
            writeup = writeup.substring(subStringLen, writeup.length);
            //regExp = new RegExp(allWords[counter],"i");
            //updateWriteUp = updateWriteUp.replace(regExp, allWords[counter]);
            //userUsedWordCount++;
            console.log('Matcing Combo ',matchingCombo);
            console.log('Replace Combo ',replaceCombo);

            var regExp = new RegExp(matchingCombo,"i");
            updateWriteUp = updateWriteUp.replace(regExp, replaceCombo);
            userUsedWordCount++;
            writeUpWords.push(allWords[counter]);
            delete allWords[counter];
          } else {
            writeup = writeup.substring(subStringLen, writeup.length);
            counter--;
          }
        } 
      }
      //
      if (writeUpWords.length) {
        //console.log('test',writeUpWords);
        //console.log('sentenceWords',sentenceWords);
        //console.log('sentenceWordsLength',sentenceWordsLength);
        for(senCounter = 0; senCounter < sentenceWordsLength; senCounter++ ) {
          words = sentenceWords[senCounter].split(",");
          wordLength = words.length;
          wordFound = false;
          findWord = '';
          for (subSenCounter = 0; subSenCounter < wordLength; subSenCounter++) {
            findWord = words[subSenCounter];
            wordIndex = writeUpWords.indexOf(findWord);
            console.log(wordIndex);
            if (wordIndex !== -1) {
              wordFound = true;
              delete writeUpWords[wordIndex];
            } else {
              wordFound = false;
              break;
            }
          }
         
      /*if (words.some(v => findWord.includes(v))) {
        console.log("came in");
      } else {
        console.log("no match");
      }*/
    
          //if (wordFound == true ) {
            //$('#jsWord-'+senCounter).addClass('strikeThrough');
            //$('#jsWriteup').toUpperCase();
            //totalwords.map(f =>{ return f.toUpperCase(); });
          //}
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
    });

  });

  function viewModal(argument) {
    
    //$('#jsview').removeClass('d-none');
    $('#editModal').modal('show');
  }  
</script>

@endsection