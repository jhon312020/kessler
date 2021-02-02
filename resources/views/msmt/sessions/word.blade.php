@extends('msmt.layouts.master')
@section('content')
      
 <!-- Main content -->
<link href="{{asset('css/app.css')}}" rel="stylesheet" />
<section class="page-section" id="jsTraineeSession">
  <div class="container">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">STORY WRITING</h2>
    <!-- Icon Divider-->
    <div class="divider-custom">
      <div class="divider-custom-line"></div>
      <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
      <div class="divider-custom-line"></div>
    </div>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <p>On the same page below you are going to see a set of 20 words. The words will be capitalized like THIS. Build a story of your own using these words. Fit in as many words in a sentence. This story is to help you remember the capitalized words. Try to make a picture of each storyline in your head. Click on START when you are ready.</p>
          <br>
      </div>
    </div>
      <!-- Contact Section Form-->
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="form-group text-center">
          <button class="btn btn-primary btn-xl" id="jsStartSession" type="button">START</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>

<section class="page-section text-center d-none" id="jsTraineeStory">
  <div class="container">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Write Your Own Story</h2>
    <!-- Icon Divider-->
    <div class="divider-custom">
      <div class="divider-custom-line"></div>
      <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
      <div class="divider-custom-line"></div>
    </div>
    <!-- Contact Section Form-->
    <form action="{{ url('read') }}" method="POST" id="writeup">
      @csrf {{ method_field('post') }}
      <div class="row" id="jsWordContainer">
        <div class="col-xs-4 col-lg-8 mx-auto">
          <div class="row">
            @foreach($words as $wordGroup)
              <div class="col-3">
                @foreach($wordGroup as $wordID=>$word)
                  <p id="jsWord-{{ $wordID }}">{{$word}}</p>
                @endforeach
              </div>
            @endforeach 
          </div>
        </div>
      </div>  
      <div class="row">  
        <div class="col-xs-4 col-lg-8 mx-auto">
          <textarea class="form-control writeup" id="jsWriteup" name="story" rows="15" placeholder="Enter Story ..." required  autofocus="on"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <div class="form-group text-center">
            <br/>
            <button class="btn btn-primary btn-xl" id="jsSubmit" type="submit">SUBMIT</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<script type="text/javascript">
  $(document).ready( function() { 
    var allWords = "{{ $allWords }}";
    allWords = allWords.split(',');
    var wordCount = allWords.length;
    //console.log('lenght', wordCount);
    //var allWordsObj = JSON.parse(allWords);
    //console.log('AllWords', allWords);
    $(document).on("keyup", "form", function(event) { 
      $('#jsWordContainer p').removeClass('strikeThrough');
      var writeup = $('#jsWriteup').val();
      $('#jsWriteup').val(writeup.toUpperCase())
      for (counter = 0; counter < wordCount; counter++) {
        if (writeup.indexOf(allWords[counter])!= -1) {
          $('#jsWord-'+counter).addClass('strikeThrough');
        }
      }
      
      
    });
    $(document).on('click', '#jsStartSession', function() {
      $('#jsTraineeSession').slideUp();
      $('#jsTraineeStory').removeClass('d-none').show();
    });
  })
</script>
@endsection