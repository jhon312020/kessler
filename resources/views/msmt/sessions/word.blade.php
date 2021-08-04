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
    var type = "{{ $type ?? '' }}";
    var arrays = "{{ $arrays ?? '' }}";
    if (type) {

      allWords = allWords.split(',');
      var wordCount = allWords.length;
      var allWordsUsed = false;
      
      var allArr = arrays.split('.');

      var wordsArr = [];
      var wordsTotal = [];
      var wordsTimes = [];
      for (counter = 0; counter < allArr.length; counter++) {
          var wordsArr2 = allArr[counter].split(",");
          wordsArr.push(wordsArr2);
        }
      
      var i = 0;
      var j = 0;
      var wordNxt = wordsArr[i][j];
     
      for (var counter = 0; counter < wordCount; counter++) {
        var count = countOccurences(allWords[counter]);
        wordsTimes.push([allWords[counter], count]);
      }
      var $rows = [];
      $(document).on("keyup", "form", function(event) { 
        
        $('#jsUserMessage').addClass('d-none');
        
        //$('#jsWordContainer p').removeClass('strikeThrough');
        var writeup = $('#jsWriteup').val().toUpperCase();
        var updateWriteUp = $('#jsWriteup').val();
        // var totWord = $("#jsWriteup").val().split(' ');
        // var lastWord = totWord[totWord.length - 2];
        // if(lastWord.toUpperCase() == wordNxt) {
        //   updateWriteUp = updateWriteUp.replace(lastWord, wordNxt);
        //   var next = getNextWord();
        //   console.log(next);
        // }
    
        if(event.which == 32){
          var totWord = $("#jsWriteup").val().split(' ');
          var lastWord = totWord[totWord.length - 2];
          if(lastWord.toUpperCase() == wordNxt) {
            updateWriteUp = updateWriteUp.replace(lastWord, wordNxt);
            var next = getNextWord();
            console.log(next);
          }
        }
        if (event.which == 188) {
          var totWord = $("#jsWriteup").val().split(' ');
          var lastWord = totWord[totWord.length - 1];
          if(lastWord.toUpperCase() == wordNxt+",") {
            updateWriteUp = updateWriteUp.replace(lastWord, wordNxt);
            var next = getNextWord();
            console.log(next);
          }
        }
        if (event.which == 190) {
          var totWord = $("#jsWriteup").val().split(' ');
          var lastWord = totWord[totWord.length - 1];
          if(lastWord.toUpperCase() == wordNxt+".") {
            updateWriteUp = updateWriteUp.replace(lastWord, wordNxt);
            var next = getNextWord();
            console.log(next);
          }
        }

        // for (var t = 0; t < wordsTimes.length; t++) {
        //   // console.log(getOccurences(writeup, wordsTimes[t][0]));
        //     if (wordsTimes[t][1] == getOccurences(writeup, wordsTimes[t][0])) {
              
        //       // wordsTimes[t][1] = 0;
        //     } else {
        //       console.log("else");
        //       // wordsTimes[t][1] = getOccurences(writeup, wordsTimes[t][0])
        //     }
        // }
        if ($rows.length > 0) {
          var $w;
          var $near;
          var $dir; 
          var $row;
          $.each($rows,function(i,v) {
            if (wordsArr[v[0]].length-1 == v[1]) {
              console.log("comes to strikeThrough");
              $w = wordsArr[v[0]][v[1]];
              $near = wordsArr[v[0]][v[1]-1];
              $dir = "left";
              $row = v[0];
            } else {
              $w = wordsArr[v[0]][v[1]];
              $near = wordsArr[v[0]][v[1]+1];
              $dir = "right";
            }
            
            searchNearBy($w,$near,$dir,$row);
           /* if ($find == true) {
              console.log(v[0]);
              $("#jsWord-"+v[0]).addClass("strikeThrough");
            }*/
          });

        }

        for (var row = 0; row < wordsArr.length; row++) {

          for (var col = 0; col < wordsArr[row].length; col++) {
            if (writeup.indexOf(' '+wordsArr[row][col]+' ')!= -1 || writeup.indexOf(' '+wordsArr[row][col]+'.') != -1 || writeup.indexOf(' '+wordsArr[row][col]+',') != -1  || writeup.indexOf(wordsArr[row][col]+' ')!= -1 ) { 

              
            } else {

             
              if($("#jsWord-"+row).hasClass("strikeThrough")) {
                console.log("comes.");
                $rows.push([row, col]);
                allWordsUsed = false;
                // for(var p = row; p <= 9; p++) {
                //   $("#jsWord-"+p).removeClass("strikeThrough");
                  $("#jsWord-"+row).removeClass("strikeThrough");
                //}
                
              }

            }
          }
        }
      });

    } else {
      allWords = allWords.split(',');
      var wordCount = allWords.length;
      var userUsedWordCount = 0;
      console.log(allWords);
      $(document).on("keyup", "form", function(event) { 
        console.log("pressed");
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
    }
    
    
   
    $(document).on('click touchstart', '#jsStartSession', function() {
      $('#jsTraineeSession').slideUp();
      $('#jsTraineeStory').removeClass('d-none').show();
    });
    $("#jsSubmit").on('click touchstart', function(event) {
      event.preventDefault();
      console.log("comes");
      $('#jsUserMessage').addClass('d-none');
      $("#jsLoader").removeClass('d-none');
      $(this).prop("disabled", true);
      if (wordCount == userUsedWordCount || allWordsUsed == true) {
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
    function getNextWord() {

      j++;
      if (j < wordsArr[i].length) {
        wordNxt = wordsArr[i][j];
      } else {
        //console.log("new array");
        $('#jsWord-'+i).addClass('strikeThrough');
        if (i == 9) {
          allWordsUsed = true;
          return;
        } else {
          i++;
          j = 0;
          wordNxt = wordsArr[i][j];
        }
        
      }
  
      
      return wordNxt;
    }
    function countOccurences(word) {
      var occurance = 0;
      $(allWords).each(function (index, value) {
           if(value.indexOf(word)!= -1) 
           {
              occurance++;
           }
      }); 
      return occurance;
    }

    function getOccurences(string,word) {
      return string.split(word).length - 1;
    }

    function searchNearBy(word,near,dir,row) {
      
      var writeup = $('#jsWriteup').val().toUpperCase();
      var sentences = writeup.split(".");
      $.each(sentences, function(i,v) {
        if(v.indexOf(word)!= -1) {
          var wordFound = i;
          if (v.indexOf(near) != -1) {
            $("#jsWord-"+row).addClass("strikeThrough");
            return false;
          } else {
            if (dir == "left") {

            }
         }
         
        }
      })
    
    }

  })

</script>
@endsection







