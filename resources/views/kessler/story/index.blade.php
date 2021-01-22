@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
 <main>
  <div class="container-fluid">
    <h1 class="mt-4">Stories</h1>
    <div class="card mb-4">
      <div class="card-body">
        Create, View, Edit and Remove Story
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
          Stories
      </div>
      <br/>
      <a href="{{ route('story.create')}}" class="btn btn-primary btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;">Add Story</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Story</th>
                <th width="12%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Story</th>
                <th colspan = 2>Actions</th>
              </tr>
            </tfoot>
            <tbody>
            @foreach($story as $story)
              <tr>
                <td>{{$story->story}}</td>
                <td>
                  <a href="{{ route('story.edit',$story->id)}}" class="btn btn-primary" role="button"><i class="fa fa-edit">&nbsp;</i>Edit</a>
                  <form action="{{ route('story.destroy', $story->id)}}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash">&nbsp;</i>Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <div>
          @if(session()->get('success'))
            <div class="alert alert-success">
              {{ session()->get('success') }}  
            </div>
          @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection