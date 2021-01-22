@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
 <main>
  <div class="container-fluid">
    <h1 class="mt-4">Trainees Information</h1>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fa fa-table mr-1"></i>
        Trainee Journey
      </div>
      <br/>
      <a href="{{ route('traineejourney.create')}}" class="btn btn-primary btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;">Add Trainee Journey</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Trainee ID</th>
                <th>Session Pin</th>
                <th>Session Type</th>
                <th>Session Number</th>
                <th width="20%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Trainee ID</th>
                <th>Session Pin</th>
                <th>Session Type</th>
                <th>Session Number</th>
                <th width="20%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($traineejourney as $traineejourney)
              <tr>
                <td>{{$traineejourney->trainee_id}}</td>
                <td>{{$traineejourney->session_pin}}</td>
                <td>{{$traineejourney->session_type}}</td>
                <td>{{$traineejourney->session_number}}</td>
                <td>
                  <a href="{{ route('traineejourney.edit',$traineejourney->id)}}" class="btn btn-primary" role="button"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                  <a href="{{ url('traineejourney/view',$traineejourney->id)}}" class="btn btn-primary" role="button"><i class="fa fa-eye">&nbsp;</i> View</a>
                  <form action="{{ route('traineejourney.destroy', $traineejourney->id)}}" method="post" class="d-inline">
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