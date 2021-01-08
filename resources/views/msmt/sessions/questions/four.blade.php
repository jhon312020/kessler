@extends('msmt.layouts.master')

  <!-- Content Wrapper. Contains page content -->
  @section('content')
  <style type="text/css">
    .fill-ups{
     line-height: 1.2;
     border: none; 
     border-bottom: 1px solid #757575;
     width: 125px;
}
  </style>
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
      <div class="container-fluid">
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
     <div class="container-fluid">
        <div class="card card-primary card-outline" id="questions"  style="display:none;" class="answer_list">
          <div class="card-header">
            <h3 class="card-title">Session 4</h3>
          </div> <!-- /.card-body -->
          <div class="card-body">
            <h1 class="m-0"></h1>
              @foreach($msmt as $story)
              <p id="showstory">{{ $story -> story}}</p>
              @endforeach           
          </div>
           <div class="card-footer">
            <button type="submit" class="btn btn-primary" style="float: right;" onclick="alert('SESSION ROUND ONE COMPLETED !!!')">COMPLETE</button>
                <br><br> 
   
                </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- /.container-fluid -->

    </section>
    <!-- /.content -->
<script type="text/javascript">
  function one() {
   document.getElementById('questions').style.display = "block";
   var s = document.getElementById("showstory").innerHTML
   var res = s.replace(/[A-Z0-9]{2,}/g, function (x) {
    return "<input class='fill-ups' style='text-align:center;'>";
    });
    document.getElementById("showstory").innerHTML = res;
}

</script>
  @endsection