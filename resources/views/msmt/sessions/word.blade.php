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
    var allWords = "{{ $allWords }}";
    console.log(allWords);
    allWords = allWords.split(',');
    var wordCount = allWords.length;
    var userUsedWordCount = 0;
    
    $(document).on("keyup", "form", function(event) { 
      $('#jsUserMessage').addClass('d-none');
      $('#jsWordContainer p').removeClass('strikeThrough');
      var writeup = $('#jsWriteup').val().toUpperCase();
      var updateWriteUp = $('#jsWriteup').val();
      userUsedWordCount = 0;
      console.log('came in');
      //$('#jsWriteup').val(writeup.toUpperCase())


      for (counter = 0; counter < wordCount; counter++) {
        var wordPostion = '';
        var checkKey = '';
        //for (combCounter = 0; combCounter < combLength; combCounter++  ) {
          wordCombination = allWords[counter];
          console.log(wordCombination);
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
              console.log('came in -', wordCombination);
              $('#jsWord-'+counter).addClass('strikeThrough');
              writeup = writeup.substring(subStringLen, writeup.length);
              var regExp = new RegExp(allWords[counter],"i");
              updateWriteUp = updateWriteUp.replace(regExp, allWords[counter]);
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