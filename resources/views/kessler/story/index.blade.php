@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet" />
  <div class="container-fluid">
    <h1 class="mt-4">Story</h1>
    <div class="card mb-4">
      <div class="card-body">
        Create, View, Edit and Remove Story
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
          Story <a href="{{ route('story.create')}}" class="btn btn-primary btn-block bg-gradient-primary float-right add-tab" ><i class="fas fa-plus">&nbsp;</i> Add Story</a>
      </div>
      <br/>
      
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="storyTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Story</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>S.No</th>
                <th>Story</th>
                <th width="25%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
            @foreach($story as $story)
              <tr>
                <td>{{$story->id}}</td>
                <td>{{$story->story}}</td>
                <td>
                  <a href="{{ route('story.edit',$story->id)}}" class="btn btn-primary" role="button"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                  <form action="{{ route('story.destroy', $story->id)}}" method="post" class="d-inline" id="jsSubmitForm-{{ $story->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger jsConfirmButton" type="button" data-value="{{ $story->id }}"><i class="fa fa-trash">&nbsp;</i> Delete</button>
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
  <script type="text/javascript">
  $(document).ready( function() { 
  $('#storyTable').DataTable({
    "pageLength": 10, 
    "ordering": false,
    "processing": true,
    "serverSide": true,
    "ajax": {
      
      "url": "{{ route('story.getStory') }}",
      
    },
    
    columns: [
        { data: "id" },
        { data: "story" },
        { data: "action" },
    ]
  });    

});  
</script> 
@include('common.confirm')
@endsection