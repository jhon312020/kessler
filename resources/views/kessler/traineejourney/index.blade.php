@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Table Trainee Journey</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                               Create, View, Edit and Delete Trainee Journey
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Trainee Journey
                            </div>
                            <br>
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
                                    <!--  <th>Status</th>  -->
                                          <th colspan = 3>Actions</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                          <th>Trainee ID</th>
                                          <th>Session Pin</th>
                                          <th>Session Type</th>
                                          <th>Session Number</th>
                                    <!--  <th>Status</th> -->
                                          <th colspan = 3>Actions</th>
                                        </tr>
                                        </tfoot>
                                          <tbody>
                                          @foreach($traineejourney as $traineejourney)
                                          <tr>
                                             <td>{{$traineejourney->trainee_id}}</td>
                                             <td>{{$traineejourney->session_pin}}</td>
                                             <td>{{$traineejourney->session_type}}</td>
                                             <td>{{$traineejourney->session_number}}</td>
                                  <!--       <td>
                                            <input data-id="{{$traineejourney->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $traineejourney->status ? 'checked' : '' }}>
                                             </td> -->
                                             <td>
                                                <a href="{{ route('traineejourney.edit',$traineejourney->id)}}" class="btn btn-primary far fa-edit"></a>
                                              </td>
                                               <td>
                                                <a href="{{ url('traineejourney/view',$traineejourney->id)}}" class="btn btn-primary far fa-eye"></a>
                                              </td>
                                              <td>
                                                  <form action="{{ route('traineejourney.destroy', $traineejourney->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger far fa-trash-alt" type="submit"></button>
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