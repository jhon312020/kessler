@extends('msmt.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <link href="{{asset('css/app.css')}}" rel="stylesheet" />
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
 <!-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Modified Story Memory Technique</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Icons</li>
            </ol>
          </div>
        </div>
      </div>
    </section>  -->
<!-- /.container-fluid -->

         <!-- Main content -->
        <section class="page-section" id="jsTraineeMessage">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">START CUES</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                <p>Following the free recall, a contextual cue, and if necessary a categorical cue, is given to facilitate recall for each of the target words. After this is completed, the process is repeated with the same story</p>
                <br>
                </div>
              </div>
 
                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                            <br />
                            <div id="success"></div>
                            <div class="form-group text-center"><button class="btn btn-primary btn-xl" id="jsStartSession" type="submit">START</button></div>
                    </div>
                </div>
            </div>
              <!-- /.container-fluid -->
        </section>

    <!--  <section class="content d-none" id="jsQuestions">
      <br><br>
      <form action="{{ url('next') }}" method="POST" id="jsQuestionForm">
        <div class="container-fluid">
          <div class="card card-primary card-outline"  class="answer_list">
            <div class="card-header story">
              <h3 class="card-title">QUES</h3>
            </div>  
      
          <div class="card-body">
              @csrf {{ method_field('post') }}
              <h1 class="m-0"></h1>
              <p id="question"> {!! $question !!} </p>    
              <button type="button" id="jsCheck" class="btn btn-link float-right">Check</button>     
            </div>
            <div class="card-footer">
              <div class="alert alert-danger d-none" role="alert" id="jsErrorMessage">
              </div>
              <div class="alert alert-info d-none" role="alert" id="jsCategoricalMessage">
              </div>
              <button type="button" id="jsNext" class="btn btn-primary float-right">Next</button>
              <br><br> 
            </div>
    
      </div>
        </div>
      </form> -->

      <!-- /.container-fluid -->
 <!--      <br><br>
    </section> -->

   <section class="page-section text-center d-none" id="jsQuestions">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">QUES</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row">
                <div class="col-lg-8 mx-auto">
                <p></p>
                <br>
                </div>
              </div>
 
                <!-- Contact Section Form-->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
               <form action="{{ url('next') }}" method="POST" id="jsQuestionForm">
                <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2" class="answer_list">
                              @csrf {{ method_field('post') }}
                              <h1 class="m-0"></h1>
                              <p id="question"> {!! $question !!}  
                             <!-- <button type="button" id="jsCheck" class="btn btn-link float-right">Check
                             </button> -->
                            </p>    
                            </div>
                            <div>
                              <div class="alert alert-danger d-none" role="alert" id="jsErrorMessage">
                              </div>
                              <div class="alert alert-info d-none" role="alert" id="jsCategoricalMessage">
                              </div>
                             <!--  <button type="button" id="jsCheck" class="btn btn-link float-right">Check</button> -->
                              <button type="button" id="jsNext" class="btn btn-primary btn-xl float-right">Next</button>
                              <br><br> 
                            </div>
                            
                          </div>
                          </form>
                        </div>

                </div>
            </div>

        </section>
    <!-- /.content -->
<script type="text/javascript">
  $(document).ready( function() { // Wait until document is fully parsed
    $(document).on('keyup', '#answer', function() {
        this.value = this.value.toUpperCase();
    });
    $(document).on("keydown", "form", function(event) { 
      if (event.key == "Enter") {
        event.preventDefault();
        $("#jsNext").trigger('click');
        return false;
      } else {
        return event.key;
      }
    });
    var timer = null;
    var categoryCueShowed = 0;
    //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $("#jsNext").on('click', function(event) {
      $('#jsCategoricalMessage').addClass('d-none');
      $('#jsErrorMessage').addClass('d-none');
      var answer = $('#answer').val();
      if (answer == '') {
        $('#jsErrorMessage').text('Please fill the blank!');
        $('#jsErrorMessage').removeClass('d-none').show();
        $('#answer').addClass('fill-ups-error');
        $('#answer').focus();
        return false;
      }
      var form = $('#jsQuestionForm');
      var startTime = timer;
      var endTime = performance.now();
      var categoryCue = categoryCueShowed; 
      var formData = form.serialize()+ "&startTime=" + startTime+ "&endTime=" + endTime + "&categoryCue=" + categoryCue; 
      $.ajax({
        type: "POST",
        url: form.attr("action"),
        data: formData,
        success: function(response) {
           if (response.completed) {
            //location.reload();
            console.log(response);
            window.location = response.redirectURL;
           } else if (response.reload) {
            console.log(response.reload);
           } else {
            timer = performance.now();
            $('#question').html(response.question);
            if (response.categorical_cue) {
              $('#jsCategoricalMessage').html(response.categorical_cue);
              $('#jsCategoricalMessage').removeClass('d-none').show();
              categoryCueShowed = 1;
              $('#answer').focus();
            } else {
              categoryCueShowed = 0;
              $('#answer').focus();
            }
           }
        },
        dataType: 'json'
      });
    });

    $('#jsStartSession').on('click', function(event) { 
      $('#jsTraineeMessage').slideUp();
      $('#jsTraineeMessage').html('');
      $('#jsQuestions').removeClass('d-none').show();
      $('#answer').focus();
      timer = performance.now();
    });
  })
  
</script>
@endsection