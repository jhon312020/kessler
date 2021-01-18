@extends('msmt.layouts.master')
<!-- Content Wrapper. Contains page content -->
@section('content')
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
       
      </div>
        <div class="col-sm-6">
       <button type="button" class="btn btn-primary text-right" id="session">SUBMIT</button>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection