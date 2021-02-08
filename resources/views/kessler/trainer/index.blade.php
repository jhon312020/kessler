@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
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
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th width="25%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
            @foreach($trainer as $trainer)
              <tr>
               <td>{{$trainer->name}}</td>
               <td>{{$trainer->email}}</td>
               <td>
                <a href="{{ route('trainer.edit',$trainer->id)}}" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                <form action="{{ route('trainer.destroy', $trainer->id)}}" method="post" class="d-inline">
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
@endsection