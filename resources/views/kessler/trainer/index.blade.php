@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{asset('css/style.css')}}" rel="stylesheet" />
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
      <a href="{{ route('trainer.create')}}" class="btn btn-primary btn-block bg-gradient-primary add-tab" ><i class="fas fa-plus">&nbsp;</i> Add Trainer</a>

      <div id="message"class="alert d-none"> </div>
      <br><br>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="TrainerTable" width="100%" cellspacing="0">
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
            <!-- @foreach($trainers as $trainer)
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
                  <input data-id="{{$trainer->id}}" name="status" value="{{$trainer->status}}" class="toggle-class jsStatus" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $trainer->status ? 'checked' : '' }}>
                  </form>
               </td> --}}               
              </tr>
            @endforeach -->
            </tbody>
          </table>
    <!-- {Modal} -->
   <div class="modal" tabindex="-1" role="dialog" id='editModal'>
  <div class="modal-dialog" role="document">
    <!-- <div id='loader' class = "transparent-background" style=" display: block; margin: 50%; width: 100px; top:  10%; position: absolute;">
      <img src='{{asset("assets/img/load.gif")}}' alt='loading' width='100px' height='100px'>
    </div> -->
     @include('msmt.common.loader')
    <form action="{{ url('trainer.update') }}" method="POST" id="jsEditForm" onsubmit="return false">
      <meta name="csrf-token" _token ="{{ csrf_token() }}">
      @csrf {{ method_field('post') }}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="jsModalTitle">Edit Trainer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger" id="editError" style="display: none;">
          </div>
          <input type="hidden" class="form-control" name="id" id="jsId">
          <p>Update Name: </p>
          <p><input type="text" class="form-control py-4" name="name" id="jsNameEdit" ></p>
        </div>
        <div class="modal-footer">
          <button type="submit" id = "jsupdate"class="btn btn-primary"><i class="fas fa-sync">&nbsp;</i> Update</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times">&nbsp;</i> Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div> 
<!-- {Modal} -->
          <div>
            <!-- @if(session()->get('success'))
              <div class="alert alert-success">
                {{ session()->get('success') }}  
              </div>
            @endif  -->
            
          </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
  $(document).ready( function() { // Wait until document is fully parse
    $(document).on('change', '.jsStatus', function() {
      event.preventDefault();
      var currentVal = $(this).parent().hasClass('btn-success');
      $(this).val(currentVal);
      var form = $('#jsStatusForm-'+$(this).data('id'));
      var url = form.attr('action');
      //return;
    $.ajax({
      method: "POST",
      url: url,
      data: form.serialize(),
      success:function(data){
        $('#message').addClass('alert-success');
        $('#message').removeClass('d-none');
        $('#message').text(data.message);
          $("#message").fadeTo(1000, 500).slideUp(500, function() {
          $("message").slideUp(500);
        });
      },
      error:function(data) {
        $('#message').addClass('alert-danger');
        $('#message').removeClass('d-none');
        $('#message').text(data.message);
      }
      //   $('.alert alert-success').text('TRAINER STATUS UPDATED!');
      //   if (currentVal) {
      //   $(this).val(1);
      //   $('.alert alert-success').removeClass('d-none');
      //   $('.alert alert-success').text('TRAINER STATUS UPDATED!');
      // } else {
      //   $(this).val(0);
      //   $('.alert alert-success').removeClass('d-none');
      //   $('.alert alert-success').text('TRAINER STATUS UPDATED!');
      // }
        
      
    });
    return false;
    }); 

    $('#jsupdate').click(function(event) { 
      $(this).prop("disabled", true);
      //console.log('came in'); 
      //$('#loader').css('display', 'block');
      $("#jsLoader").removeClass('d-none');
      //return;

      //event.preventDefault();   
      var data = {
        'name':$('#jsNameEdit').val(),
        'id':$('#jsId').val(),
        '_token': '{{csrf_token()}}'
      };
      
      $.ajax({
        method: "POST",
        url: "/trainer/update",
        data: data,
        
        
        success: function(result) {
          $('#editModal').modal('hide');
          $('#loader').css('display', 'none');  
          $('#jsupdate').prop('disabled', false);

          $('#TrainerTable').DataTable().ajax.reload(null,false);
        },
        error: function(result){
          $.each(result.responseJSON.errors,function(index,value){
            $('#editError').append('<li>'+value[0]+'</li>');
          });
          $('#editError').css('display','block');
          $('#loader').css('display', 'none');
        }
      });
   });
    
  $('#TrainerTable').DataTable({
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
      
      "url": "{{ route('trainer.getTrainer') }}",
      
    },

    "drawCallback":function( settings, json){
      
            $(".jsStatus").bootstrapToggle('destroy');                 
            $(".jsStatus").bootstrapToggle();

        },


    columns: [
        { data: "name" },
        { data: "email" },
        { data: "action" },
    ]
  });    

});  

    function openEditModal(elem) {
      $('#jsLoader').addClass('d-none');
      $('#editError').html('');
      var row = $(elem).attr('data-id');
      var username = $(elem).parents('tr').find('.jsname').text();
      $('#jsId').val(row);
      $('#jsNameEdit').val(username);
      $('#editModal').modal('show');
    }

</script> 
@include('common.confirm')
@endsection