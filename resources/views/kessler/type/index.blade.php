@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid">
    <h1 class="mt-4">Session Type</h1>
    <div class="card mb-4">
      <div class="card-body">
        Create, View, Edit and Remove Session Type
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
          Session Type
      </div>
      <br/>
      <a href="{{ route('type.create') }}" class="btn btn-primary btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;">Add Session Type</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Session Type</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>S.No</th>
                <th>Session Type</th>
                <th width="25%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
            @foreach($type as $type)
              <tr>
                <td>{{$type->id}}</td>
                <td>{{$type->type}}</td>
                <td>
                  <a href="{{ route('type.edit', $type->id)}}" class="btn btn-primary" role="button"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                  <form action="{{ route('type.destroy', $type->id)}}" method="post" class="d-inline" id="jsSubmitForm-{{ $type->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger jsConfirmButton" type="button" data-value="{{ $type->id }}"><i class="fa fa-trash">&nbsp;</i> Delete</button>
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
@include('common.confirm')
@endsection