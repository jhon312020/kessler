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
    <section class="content" id="jsTraineeMessage">
      <br><br>
      <div class="container-fluid" >
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">START CUES</h3>
          </div> <!-- /.card-body -->
          <div class="card-body">
            <h1 class="m-0"></h1>
            <p>Following the free recall, a contextual cue, and if necessary a categorical cue, is given to facilitate recall for each of the target words. After this is completed, the process is repeated with the same story</p>       
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary float-right" id="jsStartSession">START</button>
          </div>
        </div>
      </div>
      <br><br>
      <!-- /.container-fluid -->
    </section>

    <section class="content d-none" id="questions">
      <br><br>
      <form action="{{ url('next') }}" method="POST" id="jsQuestionForm">
        <div class="container-fluid">
          <div class="card card-primary card-outline"  class="answer_list">
            <div class="card-header story">
              <h3 class="card-title">QUES</h3>
            </div> <!-- /.card-body -->
            <div class="card-body">
              @csrf {{ method_field('post') }}
              <h1 class="m-0"></h1>
              <p id="question"> {!! $question !!} </p>         
            </div>
            <div class="card-footer">
              <div class="alert alert-danger d-none" role="alert" id="jsErrorMessage">
              </div>
              <div class="alert alert-info d-none" role="alert" id="jsCategoricalMessage">
              </div>
              <button type="button" id="jsNext" class="btn btn-primary float-right">Next</button>
              <br><br> 
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </form>
      <!-- /.container-fluid -->
      <br><br>
    </section>
    <!-- /.content -->
<script type="text/javascript">
  $(document).ready( function() { // Wait until document is fully parsed
    $(document).on('keyup', '#answer', function() {
        this.value = this.value.toUpperCase();
    });
    var timer = null;
    var categoryCueShowed = 0;
    //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $("#jsNext").on('click', function(event) {
      console.log('categoryCueShowed', categoryCueShowed);
      $('#jsCategoricalMessage').addClass('d-none');
      $('#jsErrorMessage').addClass('d-none');
      var answer = $('#answer').val();
      if (answer == '') {
        $('#jsErrorMessage').text('Please fill the blank!');
        $('#jsErrorMessage').removeClass('d-none').show();
        $('#answer').addClass('fill-ups-error');
        return false;
      }
      var form = $('#jsQuestionForm');
      var startTime = $("<input type='hidden'>").attr("name", "startTime").val(timer);
      form.append(startTime);
      var endTime = $("<input type='hidden'>").attr("name", "endTime").val(performance.now());
      form.append(endTime);
      var categoryCue = $("<input type='hidden'>").attr("name", "categoryCue").val(categoryCueShowed);
      form.append(categoryCue);
      var formData = form.serialize(); 
      $.ajax({
        type: "POST",
        url: form.attr("action"),
        data: formData,
        success: function(response) {
           if (response.reload) {
            //location.reload();
            console.log(response.reload);
           } else {
            timer = performance.now();
            $('#question').html(response.question);
            if (response.categorical_cue) {
              $('#jsCategoricalMessage').html(response.categorical_cue);
              $('#jsCategoricalMessage').removeClass('d-none').show();
              categoryCueShowed = 1;
            } else {
              categoryCueShowed = 0;
            }
           }
        },
        dataType: 'json'
      });
    });

    $('#jsStartSession').on('click', function(event) { 
      $('#jsTraineeMessage').slideUp();
      $('#jsTraineeMessage').html('');
      $('#questions').removeClass('d-none').show();
      timer = performance.now();
    });
  })
  
</script>
@endsection