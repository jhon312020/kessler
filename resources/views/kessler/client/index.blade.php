@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid">
    <h1 class="mt-4">Client</h1>
    <div class="card mb-4">
      <div class="card-body">
        Create, View, Edit and Delete Client
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fa fa-table mr-1"></i>
        Client
      </div>
      <br/>
      <a href="{{ route('client.create')}}" class="btn btn-primary btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;">Add Client</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>S.No</th>
                <th width="25%">Name</th>
                <th width="25%">Email</th>
                <th width="25%">Password</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>S.No</th>
                <th width="25%">Name</th>
                <th width="25%">Email</th>
                <th width="25%">Password</th>
                <th width="25%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
            @foreach($client as $client)
              <tr>
               <td>{{$client->id}}</td>
               <td>{{$client->name}}</td>
               <td>{{$client->email}}</td>
               <td>{{$client->password}}</td>
               <td>
                <a href="{{ route('client.edit',$client->id)}}" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                <form action="{{ route('client.destroy', $client->id)}}" method="post" class="d-inline">
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