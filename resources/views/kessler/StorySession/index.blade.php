@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
 <main>
  <div class="container-fluid">
    <h1 class="mt-4">Sessions</h1>
    <div class="card mb-4">
      <div class="card-body">
        Create, View, Edit and Remove Sessions
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
          Sessions
      </div>
      <br/>
      <a href="{{ route('StorySession.create') }}" class="btn btn-primary btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;">Add Session</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Name</th>
                <th width="20%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>S.No</th>
                <th>storySession</th>
                <th width="20%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
            @foreach($storySessions as $storySession)
              <tr>
                <td>{{$storySession->id}}</td>
                <td>{{$storySession->name}}</td>
                <td>
                  <a href="{{ route('StorySession.edit', $storySession->id)}}" class="btn btn-primary" role="button"><i class="fa fa-edit">&nbsp;</i>Edit</a>
                  <form action="{{ route('StorySession.destroy', $storySession->id)}}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash">&nbsp;</i> Delete</button>
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