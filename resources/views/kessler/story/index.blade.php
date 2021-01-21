@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Table Story</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Create, View, Edit and Remove Story
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                               Story
                            </div>
                            <br>
                            <a href="{{ route('story.create')}}" class="btn btn-primary btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;">Add Story</a>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                      <thead>
                                      <tr>
                                        <th>Story</th>
                                        <th colspan = 2>Actions</th>
                                      </tr>
                                      </thead>
                                       <tfoot>
                  <tr>
                    <th>Story</th>
                    <th colspan = 2>Actions</th>
                  </tr>
                  </tfoot>
                                       <tbody>
                        @foreach($story as $story)
                        <tr>
                            <td>{{$story->story}}</td>
                            <td>
                            <a href="{{ route('story.edit',$story->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('story.destroy', $story->id)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-danger" type="submit">Delete</button>
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