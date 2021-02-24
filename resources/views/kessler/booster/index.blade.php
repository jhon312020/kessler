@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid">
    <h1 class="mt-4">Booster Session</h1>
    <div class="card mb-4">
      <div class="card-body">
        Create, View, Edit and Remove Booster Session 
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
          Booster Session 
      </div>
      <br/>
      <a href="{{ route('booster.create') }}" class="btn btn-primary btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;"><i class="fas fa-plus">&nbsp;</i> Add Booster Session</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Booster Session</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>S.No</th>
                <th>Booster Session</th>
                <th width="25%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
            @foreach($booster as $booster)
              <tr>
                <td>{{$booster->id}}</td>
                <td>{{$booster->category}}</td>
                <td>
                  <a href="{{ route('booster.edit', $booster->id)}}" class="btn btn-primary" role="button"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                  <form action="{{ route('booster.destroy', $booster->id)}}" method="post" class="d-inline" id="jsSubmitForm-{{ $booster->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger jsConfirmButton" booster="button" data-value="{{ $booster->id }}"><i class="fa fa-trash">&nbsp;</i> Delete</button>
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