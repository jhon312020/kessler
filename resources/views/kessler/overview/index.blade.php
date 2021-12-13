@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid">
    <h1 class="mt-4">Overview</h1>
    <div class="card mb-4">
      <div class="card-body">
            Create, View, Edit and Remove Overview
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Overview
      </div>
      <br/>
      <a href="{{ route('overview.create')}}" class="btn btn-primary btn-block bg-gradient-primary add-tab" ><i class="fas fa-plus">&nbsp;</i> Add Overview</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="overviewTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Overview</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Overview</th>
                <th width="25%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($overview as $overview)
              <tr>
                <td>{{$overview->overview}}</td>
                <td>
                  <a href="{{ route('overview.edit',$overview->id)}}" class="btn btn-primary" role="button"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                  <form action="{{ route('overview.destroy', $overview->id)}}" method="post" class="d-inline" id="jsSubmitForm-{{ $overview->id }}">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger jsConfirmButton" type="button" data-value="{{ $overview->id }}"><i class="fa fa-trash">&nbsp;</i> Delete</button>
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
    $('#overviewTable').DataTable({
    "pageLength": 10, 
    "ordering": false,
    "processing": true,
    "serverSide": true,
    "ajax": {
      
      "url": "{{ route('overview.getOverview') }}",
      
    },
    
    columns: [
        { data: "overview" },
        { data: "action" },
    ]
  });    

});  
</script> 
@include('common.confirm')
@endsection