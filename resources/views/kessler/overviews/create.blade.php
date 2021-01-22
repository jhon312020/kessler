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
            <h3 class="card-title">MSMT Overview</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('overviews.store') }}">
          @csrf
              <div class="card-body">
              <div class="row">
              <div class="col-sm-6">
              <div class="form-group">
              <label for="overviews">Add Overview</label>
              <textarea class="form-control" name="overviews" style="margin-left: 100px; margin-right: 50px; height: 300px;" rows="30" cols="150" placeholder="Enter ..."  autofocus></textarea>
                
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
          <!--/.col (left) -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
@endsection