@extends('msmt.layouts.master')
@section('content')
      
 <!-- Main content -->
<link href="{{asset('css/app.css')}}" rel="stylesheet" />
<section class="page-section" id="jsTraineeSession">
  <div class="container">
    <!-- Contact Section Heading-->
    <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">START SESSION</h2>
    <!-- Icon Divider-->
    <div class="divider-custom">
      <div class="divider-custom-line"></div>
      <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
      <div class="divider-custom-line"></div>
    </div>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <p>On the same page below you are going to see a set of 20 words. The words will be capitalized like THIS. Build a story of your own using these words. This story is to help you remember the capitalized words. Try to make a picture of each storyline in your head. Click on START when you are ready.</p>
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
    <div class="row">
      <div class="col">
        <div class="control-group">
          <div class="form-group controls mb-0 pb-2">
            <div class="container">
              <div class="row">
                <div class="col-lg-8 mx-auto">
                   <form action="{{ url('wordstostory') }}" method="POST" id="writeup">
                   @csrf {{ method_field('post') }}
                    <div class="control-group">
                      <div class="form-group">
                        <div class="col-15">
                        <ul class="sort">
                          @foreach($wordStory as $wordStory)
                            <li>{{$wordStory->word}}</li>
                          @endforeach
                        </ul>
                        </div>    
                    </div>
                    <div class="control-group">
                    <div class="form-group">
                      <div class="col-10">
                      <textarea class="form-control writeup" id="writeup" name="story" rows="5" placeholder="Enter Story ..." required  autofocus="on"></textarea>
                    </div>
                  </div>
                </div>
              </div>
                <div class="form-group">
                  <button class="btn btn-primary btn-xl" id="jsSubmit" type="submit">SUBMIT</button>
              </div>
            </form>
           </div>
          </div>
         </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready( function() { 
    $(document).on('click', '#jsStartSession', function() {
      $('#jsTraineeSession').slideUp();
      $('#jsTraineeStory').removeClass('d-none').show();
    });
    $('#jsStartSession').on('click', function(event) { 
        
    });
  })
</script>
@endsection