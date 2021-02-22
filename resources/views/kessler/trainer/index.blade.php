@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
 <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <div class="container-fluid">
    <h1 class="mt-4">Trainer</h1>
    <div class="card mb-4">
      <div class="card-body">
        Create, View, Edit and Delete Trainer
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fa fa-table mr-1"></i>
        Trainer
      </div>
      <br/>
      <a href="{{ route('trainer.create')}}" class="btn btn-primary btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;">Add Trainer</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th width="25%">Actions</th>
                <!-- <th>Status</th> -->
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th width="25%">Actions</th>
                <!-- <th>Status</th> -->
              </tr>
            </tfoot>
            <tbody>
            @foreach($trainers as $trainer)
              <tr>
               <td>{{$trainer->name}}</td>
               <td>{{$trainer->email}}</td>
               <td>
                <a href="{{ route('trainer.edit',$trainer->id)}}" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i> Edit</a>
               {{--  <form action="{{ route('trainer.destroy', $trainer->id)}}" method="post" class="d-inline" id="jsSubmitForm-{{ $trainer->id }}">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger jsConfirmButton" type="button" data-value="{{ $trainer->id }}"><i class="fa fa-trash">&nbsp;</i> Delete</button>
                </form> --}}
                <form action="{{route('trainer.status',$trainer->id)}}" method="post" class="d-inline" id="jsStatusForm-{{$trainer->id}}">
                  @csrf {{ method_field('post') }}
                  <input data-id="{{$trainer->id}}" name="status" value="{{$trainer->status}}" class="toggle-class jsStatus" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $trainer->status ? 'checked' : '' }}>
                </form>
                </td>                                  
               {{-- <td>
                  <form action="{{route('trainer.status',$trainer->id)}}" method="post" class="d-inline" id="jsStatusForm-{{$trainer->id}}">
                  @csrf
                  <input data-id="{{$trainer->id}}" id="jsStatus" name="status" value="{{$trainer->status}}" class="toggle-class status" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $trainer->status ? 'checked' : '' }}>
                  </form>
               </td> --}}               
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
  $(document).ready( function() { // Wait until document is fully parse
    $('.jsStatus').on('change', function() {
      var currentVal = $(this).val();
      if (currentVal) {
        $(this).val(1);
      } else {
        $(this).val(0);
      }
      $('#jsStatusForm-'+$(this).data('id')).submit();

      /* THROUGH AJAX */

      /*var status = $(this).prop('checked') == true ? 1 : 0; 
      var id = $(this).data('id'); 
      console.log(id);
      console.log(status);
       $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });  
        $.ajax({
            type: "POST",
            url:  "/trainer/status/"+id+"",
            data: {'status': status, 'id': id},
            success: function(response){
               //console.log(response)
               console.log('id',id)
               console.log('status',status)
               if (status == 1) {
                //console.log("works"); // Conditions enters in after checking through console alert "works"
                    $('.status-'+id).html('Inactive');
                } else {
                    $('.status-'+id).html('Active');
                }
            }
        });*/
    }) 
 })
</script>
@include('common.confirm')
@endsection