@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet" />
  <div class="container-fluid">
    <h1 class="mt-4">To-Do</h1>
    <div class="card mb-4">
      <div class="card-body">
        Create, View, Edit and Delete To-Do
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fa fa-table mr-1"></i>
        To-Do
      </div>
      <br/>
      <a href="{{ route('todo.create')}}" class="btn btn-primary btn-block bg-gradient-primary add-tab" ><i class="fas fa-plus">&nbsp;</i> Add To-Do</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="todoTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>S.No</th>
                <th width="25%">To-Do</th>
                <th width="25%">Categorical Cue</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>S.No</th>
                <th width="25%">To-Do</th>
                <th width="25%">Categorical Cue</th>
                <th width="25%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
            <!-- @foreach($todo as $todo)
              <tr>
               <td>{{$todo->id}}</td>
               <td>{{$todo->task}}</td>
               <td>{{$todo->categorical_cue}}</td>
               <td>
                <a href="{{ route('todo.edit',$todo->id)}}" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                <form action="{{ route('todo.destroy', $todo->id)}}" method="post" class="d-inline" id="jsSubmitForm-{{ $todo->id }}">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger jsConfirmButton" type="button" data-value="{{ $todo->id }}"><i class="fa fa-trash">&nbsp;</i> Delete</button>
                </form>
                </td>
              </tr>
            @endforeach -->
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
    $('#todoTable').DataTable({
    "pageLength": 10, 
    "ordering": false,
    "processing": true,
    "serverSide": true,
    "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables', JSON.stringify(oData) );
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables') );
        },
    "ajax": {
      
      "url": "{{ route('todo.getTodo') }}",
      
    },
    
    columns: [
        { data: "id"},
        { data: "todo" },
        { data: "categorical_cue" },
        { data: "action" },
    ]
  });    

});  
</script>
@include('common.confirm')
@endsection