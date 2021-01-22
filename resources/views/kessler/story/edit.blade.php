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
        <br /> 
        @endif
          </div>
<!--           <div class="col-sm-6">
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
          <div class="col-md-20">
            <!-- general form elements -->
           <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">MSMT Story</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('story.update', $story->id) }}">
            @method('PATCH') 
            @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="story">Change Story</label>
                        <textarea class="form-control" name="story" style="margin-left: 100px; margin-right: 50px; height: 300px;" rows="30" cols="150" placeholder="Enter ..." autofocus value={{$story->story}}></textarea>
              </div>
                </div>
                  </div>
                    </div>
                <!-- /.card-body -->
               <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
               </div>
               </form>
                </div>
                  </div>
                    </div>
                      </div>
    </section>
  
      </div>

<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection