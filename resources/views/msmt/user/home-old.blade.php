@extends('msmt.layouts.master')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Trainee Journey</h1>
          </div>
<!--           <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div> -->
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Generate Session Pin</h3>
                <div class="container" style="width:65%">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
                </div>
                @endif
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="traineejourney"  method="post" action="{{ url('/sendemail/send') }}">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="traineeid">Trainee ID</label>
                    <input type="text" class="form-control" id="traineeid" name="traineeid" placeholder="Enter Trainee ID" required>
                  </div>
                  <div class="form-group">
                    <label for="sessiontype">Session Type</label>
                    <input type="text" class="form-control" id="sessiontype" name="sessiontype" placeholder="Session Type" required>
                  </div>
                   <div class="form-group">
                 <div class="form-group">
                  <label>Session Number</label>
                  <select class="form-control select2" style="width: 100%;" required>
                    <option selected="selected">Session Number</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                  </select>
                </div>
<!--                   <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
               <!-- <button type="submit" class="btn btn-primary">Generate Session Pin</button>
                <br><br> -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Generate Session Pin
                </button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            <!-- general form elements -->
        </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
            <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Session Pin</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <div class="form-group">
                    <label for="sessionpin">Enter Session Pin&#58;</label>
                    <input type="number" class="form-control" id="sessionpin" placeholder="Session Pin">
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <!--  <button type="button" class="btn btn-primary">Start Session</button> -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-defaults">
               Start Session
                </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- /. SESSION INSTRUCTIONS MODEL-->
        <div class="modal fade" id="modal-defaults">
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
                    <p for="sessionstart">On the next page you are going to see a story. It will stay on the screen for a set period of time. Certain words in the story will be capitalized like THIS. Use this story to help you remember the capitalized words. Try to make a picture of each storyline in your head. Click continue when ready&hellip;</p>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="alert('navigate to page to begin particular session');">Continue</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  
@endsection
