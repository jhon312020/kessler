@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid">
    <h1 class="mt-4">Word</h1>
    <div class="card mb-4">
      <div class="card-body">
        Create, View, Edit and Delete Word
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fa fa-table mr-1"></i>
        Word
      </div>
      <br/>
      <a href="{{ route('word.create')}}" class="btn btn-primary btn-block bg-gradient-primary add-tab" ><i class="fas fa-plus">&nbsp;</i> Add Word</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="wordTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>S.No</th>
                <th width="25%">Word</th>
                <th width="25%">Contextual Cue</th>
                <th width="25%">Categorical Cue</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>S.No</th>
                <th width="25%">Word</th>
                <th width="25%">Contextual Cue</th>
                <th width="25%">Categorical Cue</th>
                <th width="25%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
            <!-- @foreach($word as $word)
              <tr>
               <td>{{$word->id}}</td>
               <td>{{$word->word}}</td>
               <td>{{$word->contextual_cue}}</td>
               <td>{{$word->categorical_cue}}</td>
               <td>
                <a href="{{ route('word.edit',$word->id)}}" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                <form action="{{ route('word.destroy', $word->id)}}" method="post" class="d-inline" id="jsSubmitForm-{{ $word->id }}">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger jsConfirmButton" type="button" data-value="{{ $word->id }}"><i class="fa fa-trash">&nbsp;</i> Delete</button>
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
    $('#wordTable').DataTable({
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
      
      "url": "{{ route('word.getWord') }}",
      
    },
    
    columns: [
        { data: "id" },
        { data: "word" },
        { data: "contextual_cue" },
        { data: "categorical_cue" },
        { data: "action" },
    ]
  });    

});  
</script> 
@include('common.confirm')
@endsection