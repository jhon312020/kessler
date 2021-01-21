@extends('kessler.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Trainee Journey</h1>
             <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif
          </div>
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
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               <form method="post" action="{{ route('traineejourney.store') }}">
                 @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="trainee_id">Trainee ID</label>
                    <input type="text" class="form-control" id="trainee_id" name="trainee_id" placeholder="Enter Trainee ID" required>
                  </div>
                  <div class="form-group">
                    <label for="session_type">Session Type</label>
                    <input type="text" class="form-control" id="session_type" name="session_type" placeholder="Session Type" required>
                  </div>
                   <div class="form-group">
                 <div class="form-group">
                  <label for="session_number">Session Number</label>
                  <select class="form-control select2" style="width: 100%;" id="session_number" name="session_number" required>
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
               <button type="submit" class="btn btn-primary">Generate Session Pin</button>
                <br><br>
                </div>
              </form>
              
            </div>
            <!-- /.card -->

            <!-- general form elements -->

            <!-- /.card -->

            <!-- /.card -->


          </div>
          <!--/.col (left) -->
 
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
