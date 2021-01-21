@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
               @if ($errors->any())
              <div class="alert alert-danger">
                      <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                      </ul>
              </div>
               @endif
         <!--  <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
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
                <h3 class="card-title">MSMT Word</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('words.update', $words->id) }}">
            @method('PATCH') 
            @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="words">Update Word</label>
                    <input autofocus type="text" class="form-control" name="words" id="words" maxlength="250" placeholder="Enter word" value={{$words->words}}>
                  </div>
                   <div class="form-group">
                    <label for="contextual_cue">Update Contextual Cue</label>
                    <input autofocus type="text" class="form-control" name="contextual_cue" id="contextual_cue" placeholder="Enter contextual cue" maxlength="250" value={{ $words->contextual_cue }}>
                   </div>
                  <div class="form-group">
                    <label for="categorical_cue">Update Categorical Cue</label>
                    <input autofocus type="text" class="form-control" name="categorical_cue" id="categorical_cue" placeholder="Enter categorical cue" maxlength="250" value={{ $words->categorical_cue }}>
                    
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection