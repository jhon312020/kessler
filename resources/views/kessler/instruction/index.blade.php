@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet" />
  <div class="container-fluid">
    <h1 class="mt-4">Instruction</h1>
    <div class="card mb-4">
      <div class="card-body">
            Create, View, Edit and Remove Instruction
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Instruction
      </div>
      <br/>
      <a href="{{ route('instruction.create')}}" class="btn btn-primary btn-block bg-gradient-primary add-tab"><i class="fas fa-plus">&nbsp;</i> Add Instruction</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Instruction</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Instruction</th>
                <th width="25%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($instruction as $instruction)
              <tr>
                <td>{{$instruction->instruction}}</td>
                <td>
                  <a href="{{ route('instruction.edit',$instruction->id)}}" class="btn btn-primary" role="button"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                  <form action="{{ route('instruction.destroy', $instruction->id)}}" method="post" class="d-inline" id="jsSubmitForm-{{ $instruction->id }}">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger jsConfirmButton" type="button" data-value="{{ $instruction->id }}"><i class="fa fa-trash">&nbsp;</i> Delete</button>
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