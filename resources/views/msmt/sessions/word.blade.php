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
       <p>Below you are going to see a list of 20 words. The words will be capitalized like <span class="emboss">THIS</span>. <p>Build a story of your own using these words. You can use multiple words in a sentence, but you want each sentence to be as easy to visualize as possible. The purpose of the story is to help you remember the capitalized words - you want to be able to create a picture of the storyline in your head.</p><p>Click on <span class="emboss">START</span> when you are ready.</p>
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
    allWords = allWords.split(',');
    var wordCount = allWords.length;
    var userUsedWordCount = 0;
    console.log(allWords);
    $(document).on("keyup", "form", function(event) { 
      $('#jsUserMessage').addClass('d-none');
      $('#jsWordContainer p').removeClass('strikeThrough');
      var writeup = $('#jsWriteup').val().toUpperCase();
      var updateWriteUp = $('#jsWriteup').val();
      userUsedWordCount = 0;
      //$('#jsWriteup').val(writeup.toUpperCase())
      for (counter = 0; counter < wordCount; counter++) {
        if (writeup.indexOf(' '+allWords[counter]+' ')!= -1 || writeup.indexOf(' '+allWords[counter]+'.') != -1 || writeup.indexOf(' '+allWords[counter]+',') != -1  || writeup.indexOf(allWords[counter]+' ')!= -1 ) {
          $('#jsWord-'+counter).addClass('strikeThrough');
          var regExp = new RegExp(allWords[counter],"i");
          updateWriteUp = updateWriteUp.replace(regExp, allWords[counter]);
          userUsedWordCount++;
        } else {
          var regExp = new RegExp(allWords[counter],"gi");
          updateWriteUp = updateWriteUp.replace(regExp, allWords[counter].toLowerCase());
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