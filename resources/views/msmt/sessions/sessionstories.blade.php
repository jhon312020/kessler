@extends('msmt.layouts.master')

  <!-- Content Wrapper. Contains page content -->
@section('content')
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
     <br><br>
  <section class="content">
     <div class="container-fluid" id="time">
      
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">START SESSION</h3>
        </div> <!-- /.card-body -->
          <div class="card-body">
          <h1 class="m-0"></h1>
          <p>On the same page below you are going to see a story. It will stay on the screen for a
          set period of time. Certain words in the story will be capitalized like THIS. Use this story to help you remember the capitalized words. Try to make a picture of each storyline in your head. Click on START when you are ready.</p>
          </div>
        
      <div class="card-footer">
    <!-- <button type="submit" class="btn btn-primary">Generate Session Pin</button>
                <br><br> -->
        <button type="button" class="btn btn-primary" id="start" style="float: right;" onclick="display();">START</button>
      </div>

      <!-- /.container-fluid -->
  </section>
 <br><br>
    <section class="content">
      <div class="container-fluid" style="display:none;" id="story">
        <div class="card card-primary card-outline">
          <div class="card-header">
          <h3 class="card-title">Session Story</h3>
          </div> <!-- /.card-body -->
        <div class="card-body" id="time-out">
          <h1 class="m-0"></h1>
              @foreach($msmt as $story)
              <p>{{ $story -> story}}</p>
              @endforeach
        </div>
        <div class="card-footer">
        <button type="submit" class="btn btn-primary" style="float:right;" onclick="window.location.replace('/recallwords');">CONTINUE</button>
        </div>
          <!-- /.card-body -->
        </div>
        </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <br><br>
    <script type="text/javascript">
      function display() {
        document.getElementById('story').style.display = "block";
        $('#time').slideUp();
      }
      /*setTimeout(function() {
      $('#time').fadeOut('fast');
      }, 1000);*/
    </script>
    
    <script type="text/javascript">
      setTimeout(function() {
      $('#time-out').fadeOut('fast');
      }, 120000); // <-- time in milliseconds
    </script>
@endsection