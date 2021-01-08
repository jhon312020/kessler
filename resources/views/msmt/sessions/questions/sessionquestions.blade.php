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
       <section class="content">
           <br><br>
      <div class="container-fluid" id="time">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">START CUES</h3>
          </div> <!-- /.card-body -->
          <div class="card-body">
            <h1 class="m-0"></h1>
         <p>Following the free recall, a contextual cue, and if necessary a categorical cue, is given to facilitate recall for each of the target words. After this is completed, the process is repeated with the same story</p>
                    
          </div>
          <div class="card-footer">
    <!-- <button type="submit" class="btn btn-primary">Generate Session Pin</button>
                <br><br> -->
    <button type="button" class="btn btn-primary" style="float: right;" onclick="one();">START</button>
                </div>
      <!-- /.container-fluid -->
    </section>

    <section class="content">
     <!--  <form method="POST" action="{{url('store-json')}}">
         {{ csrf_field() }}
         {{ method_field('PUT') }}) -->
            <br><br>
     <div class="container-fluid">
        <div class="card card-primary card-outline" id="questions"  style="display:none;" class="answer_list">
          <div class="card-header">
            <h3 class="card-title">QUES</h3>
          </div> <!-- /.card-body -->
          <div class="card-body">
            <h1 class="m-0"></h1>
              @foreach($msmt as $story)
              <p id="showstory">{{ $story -> story}}</p>
              @endforeach           
          </div>
        <!--  <div class="card-body">
        <label for="words">ENTER YOUR ANSWERS WITH SPACE or COMMA</label>
        <input type="text" name='fill-ups' id='fill-ups' class="form-control" id="words" placeholder="Please enter word">
        <div class="card-body">
         <button type="submit" class="btn btn-success" style="float: right;" onclick="display();">Submit</button><br>
         </div>
        </div> -->
           <div class="card-footer">
             
            <button type="submit" class="btn btn-primary" style="float: right;" onclick="alert('SESSION ROUND ONE COMPLETED !!!')">COMPLETE</button>
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
  function one() {
      $('#time').slideUp();
      document.getElementById('questions').style.display = "block";
      var s = document.getElementById("showstory").innerHTML
      var res = s.replace(/[A-Z0-9]{2,}/g, function (x) {
      return "<input class='fill-ups' id='fill-ups' style='text-align:center;' onkeypress='color(this);'>";
      });
      document.getElementById("showstory").innerHTML = res;
      /*setTimeout(function() {
     $('#time').fadeOut('fast');
     }, 1000); */
    }
</script>

<script type="text/javascript">
  function color(el)
    {
     // alert('if correct answer change text color to green else red');
  /*    if( 
    el.value == "APPLE"|| 
    el.value == "BLOSSOM"|| 
    el.value == "BUTTER"|| 
    el.value == "CHAIR"|| 
    el.value == "COFFEE"|| 
    el.value == "DIAMOND"|| 
    el.value == "FACTORY"|| 
    el.value == "FORK"|| 
    el.value == "HAMMER"||    
    el.value == "KISS"|| 
    el.value == "MARKET"|| 
    el.value == "PALACE"||
    el.value == "PRIEST"||
    el.value == "SEAT"||
    el.value == "STEAM"||
    el.value == "TICKET"||
    el.value == "WIFE"||
    el.value == "BETRAYAL"||
    el.value == "DISCRETION"||
    el.value == "GENDER")
    {
      el.style.color='green';

    }
    else {
      el.style.color='red';

    }*/
    }
</script>
<script type="text/javascript">
  function display() {
   document.getElementById('story').style.display = "block";
}
</script>
@endsection