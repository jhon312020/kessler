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
    let singleSpace = ' ';

    $(document).on("keyup", "form", function(event) { 
      allWords = totalwords.split(',');
      console.log(allWords);
      $('#jsUserMessage').addClass('d-none');
      //$('#jsWordContainer p').removeClass('strikeThrough');
      //$('#jsWordContainer p span').removeClass('strikeThrough');
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
          /*if (wordPosition != -1) {
            //subStringLen = parseInt(wordPosition) + parseInt(wordCombination.length);
            console.log('Start', startOfWord, 'endOfWord', endOfWord);
            //For left user types lefthand in this case word left is getting matched so restting the substring
            if ((startOfWord == '' || startOfWord == ' ') && (endOfWord =='.' || endOfWord == ',' || endOfWord == ' ' || endOfWord == '') && typeof(endOfWord) !== 'undefined') {
              // console.log("updateWriteUp", updateWriteUp);
              console.log('matchingCombo', matchingCombo, 'wordPosition',wordPosition);
              //$('#jsWord-'+counter).addClass('strikeThrough');
              var regExp = new RegExp(matchingCombo,"i");
              updateWriteUp = updateWriteUp.replace(regExp, replaceCombo);
              userUsedWordCount++;
          } else {
            var regExp = new RegExp(allWords[counter],"gi");
            updateWriteUp = updateWriteUp.replace(regExp, allWords[counter].toLowerCase());
            //console.log(updateWriteUp);
          }
        }*/
      }
      $('#jsWriteup').val(updateWriteUp)
    });
    /*$(document).on('click touchstart', '#jsStartSession', function() {
      $('#jsTraineeSession').slideUp();
      $('#jsTraineeStory').removeClass('d-none').show();
    });*/
    $("#jsSubmit").on('click touchstart', function(event) {
      event.preventDefault();
      $('#jsUserMessage').addClass('d-none');
      $("#jsLoader").removeClass('d-none');
      $(this).prop("disabled", true);
      if (wordCount == userUsedWordCount) {
        $("#jsFormWriteup").submit();
        console.log(userUsedWordCount);
      } else {
        console.log(userUsedWordCount);
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