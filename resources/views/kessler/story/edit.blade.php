@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Story</h3></div>
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
            <form method="post" action="{{ route('story.update', $story->id) }}">
              @method('PATCH') 
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="story">Update Story</label>
                <textarea class="form-control py-4" name="story"  style="height: 218px;" rows="30" cols="150" placeholder="Enter Story ..." autofocus value={{$story->story}}></textarea>
              </div>
              <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection