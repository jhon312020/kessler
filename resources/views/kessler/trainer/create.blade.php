@extends('kessler.layouts.master')
@section('content')
<link href="{{asset('css/bootstrap-multiselect.css')}}" rel="stylesheet" />
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Trainer</h3></div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="post" action="{{ route('trainer.store') }}">
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="name">Enter Name</label>
                <input type="text" class="form-control py-4" id="name" name="name" placeholder="Enter name" required>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="email">Enter email address</label>
                <input type="email" class="form-control py-4" id="email" name="email" placeholder="Enter email address" required>
              </div>
              <div class="form-group" id="jsCategory">
              <label class="small mb-1" for="category">Category Type</label><br>
              <select class="form-control select2" id="category" name="category[]" required placeholder="Select Category Type" multiple="multiple">
                
                @foreach($category as $categories)
                  <option value="{{ $categories->category }}">{{ $categories->category }}</option>
                @endforeach;
                
              </select>
            </div>
           <!--    <div class="form-group">
                <label class="small mb-1" for="password">Enter Password</label>
                <input type="password" class="form-control py-4" id="password" name="password" placeholder="Enter Password" required>
              </div> -->
              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus">&nbsp;</i> Add</button>
                <a href="{{ url('/trainer')}}" class="ml-2 btn btn-danger" role="button"><i class="fas fa-times">&nbsp;</i> Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-multiselect.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#category').multiselect();
    });
</script>


@endsection
