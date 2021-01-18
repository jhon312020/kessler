@extends('msmt.layouts.master')
@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

  <!--   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modified Story Memory Technique</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Icons</li>
            </ol>
          </div>
        </div>
      </div>
    </section>   -->
<!-- /.container-fluid -->
      
         <!-- Main content -->
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
                <p>On the same page below you are going to see a story. It will stay on the screen for a
                set period of time. Certain words in the story will be capitalized like THIS. Use this story to help you remember the capitalized words. Try to make a picture of each storyline in your head. Click on START when you are ready.</p>
                <br>
                </div>
              </div>
 
                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                          
                            <div id="success"></div>
                            <div class="form-group text-center"><button class="btn btn-primary btn-xl" id="jsStartSession" type="submit">START</button></div>
                    </div>
                </div>
            </div>
              <!-- /.container-fluid -->
        </section>
 
  <section class="page-section text-center d-none" id="jsTraineeStory">
            <div class="container">
                <!-- Contact Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Session Story</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>

                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
               <form action="{{ url('recallwords') }}" method="POST" id="jsQuestionForm">
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0 pb-2" id="time-out">
                   
                      @foreach($msmt as $story)
                      <p>{{ $story -> story}}</p>
                      @endforeach
                  </div>
                <div class="form-group text-center">
               <button type="button" id="jsContinue" class="btn btn-primary btn-xl">CONTINUE</button>
              <br><br> 
               </div>
              </div>
             </form>
              </div>
              </div>
            </div>
        </section>

    <script type="text/javascript">
      $(document).ready( function() { 
      $('#jsStartSession').on('click', function(event) { 
      $('#jsTraineeSession').slideUp();
      $('#jsTraineeStory').removeClass('d-none').show();
      setTimeout(function() {
      $('#time-out').fadeOut('fast');
      }, 120000); // <-- time in milliseconds
    });
       $('#jsContinue').on('click', function(event) { 
        window.location.replace('/recallwords');
    });
    })
    </script>

@endsection