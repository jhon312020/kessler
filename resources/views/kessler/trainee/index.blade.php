@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
 <main>
  <div class="container-fluid">
    <h1 class="mt-4">Trainees Information</h1>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fa fa-table mr-1"></i>
        Trainees Information
      </div>
      <br/>
      <a href="{{ route('trainee.create')}}" class="btn btn-primary btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;">Add Trainee</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Trainee ID</th>
                <th>Session Pin</th>
                <th>Session Type</th>
                <th>Session Number</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Trainee ID</th>
                <th>Session Pin</th>
                <th>Session Type</th>
                <th>Session Number</th>
                <th width="25%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($trainees as $trainee)
              <tr>
                <td>{{$trainee->trainee_id}}</td>
                <td>{{$trainee->session_pin}}</td>
                <td>{{$trainee->session_type}}</td>
                <td>{{$trainee->session_number}}</td>
                <td>
                  <a href="{{ route('trainee.edit',$trainee->id)}}" class="btn btn-primary" role="button"><i class="fas fa-edit">&nbsp;</i> Edit</a>
                  <a href="{{ url('trainee/view',$trainee->id)}}" class="btn btn-primary" role="button"><i class="fas fa-eye">&nbsp;</i> View</a>
                  {{-- <form action="{{ route('trainee.destroy', $trainee->id)}}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash">&nbsp;</i> Delete</button>
                  </form> --}}
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