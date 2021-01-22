@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
<main>
  <div class="container-fluid">
    <h1 class="mt-4">Words</h1>
    <div class="card mb-4">
      <div class="card-body">
        Create, View, Edit and Delete Word
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fa fa-table mr-1"></i>
        Words
      </div>
      <br/>
      <a href="{{ route('words.create')}}" class="btn btn-primary btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;">Add Word</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Word</th>
                <th>Contextual Cue</th>
                <th>Categorical Cue</th>
                <th width="12%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Word</th>
                <th>Contextual Cue</th>
                <th>Categorical Cue</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
            @foreach($words as $words)
              <tr>
               <td>{{$words->word}}</td>
               <td>{{$words->contextual_cue}}</td>
               <td>{{$words->categorical_cue}}</td>
               <td>
                <a href="{{ route('words.edit',$words->id)}}" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                <form action="{{ route('words.destroy', $words->id)}}" method="post" class="d-inline">
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