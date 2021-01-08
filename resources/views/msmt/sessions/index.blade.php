@extends('msmt.layouts.master')

 <!-- Content Wrapper. Contains page content -->
  @section('content')

<link href="">

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
<!--           <div class="col-sm-6">
            <h1>Modified Story Memory Technique</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Icons</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Overview</h3>
          </div> <!-- /.card-body -->
          <div class="card-body">
          	<h1 class="m-0"></h1>
                <br>
             @foreach($overviews as $overviews)
                    <ul>
                        <li>{{ $overviews -> overviews}}</li>
                       
                    </ul>
                    
                    @endforeach
           
          </div><!-- /.card-body -->
            <div class="col-sm-6">
           <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" style="float: right;" onclick="session();">START SESSIONS</button> -->
           <button type="button" class="btn btn-primary text-right" id="session">SUBMIT</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
        
<!--         <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Sessions</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
             <div class="form-group">
              <div class="row">
              <div class="column">
                <p>SESSION TYPE A</p>
              <button type = "submit" class="btn btn-primary" onclick="window.location.replace('sessions/one');">SESSION 1</button>
              <button type = "submit" class="btn btn-primary" onclick="window.location.replace('sessions/two');">SESSION 2</button>
              <button type = "submit" class="btn btn-primary" onclick="window.location.replace('sessions/three');">SESSION 3</button>
              <button type = "submit" class="btn btn-primary" onclick="window.location.replace('sessions/four');">SESSION 4</button>
            </div>

            </div>
               </div>
            </div>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="window.location.replace('home');">HOME</button>
            </div>
          </div> -->
          <!-- /.modal-content -->
      <!--   </div> -->
        <!-- /.modal-dialog -->
     <!--  </div> -->
      <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>

  @endsection