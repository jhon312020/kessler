@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="container-fluid">
    <h1 class="mt-4">Quiz</h1>
    <div class="card mb-4">
      <div class="card-body">
        Create, View, Edit and Delete Quiz
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fa fa-table mr-1"></i>
        Quiz
      </div>
      <br/>
      <a href="{{ route('quiz.create')}}" class="btn btn-primary btn-block bg-gradient-primary" style="width: fit-content; margin-left: 25px;">Add Quiz</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>S.No</th>
                <th width="25%">Question</th>
                <th width="25%">One Word Answer</th>
                <th width="25%">Sentence Answer</th>
                <th width="25%">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>S.No</th>
                <th width="25%">Question</th>
                <th width="25%">One Word Answer</th>
                <th width="25%">Sentence Answer</th>
                <th width="25%">Actions</th>
              </tr>
            </tfoot>
            <tbody>
            @foreach($quiz as $quiz)
              <tr>
               <td>{{$quiz->id}}</td>
               <td>{{$quiz->question}}</td>
               <td>{{$quiz->one_word_answer}}</td>
               <td>{{$quiz->sentence_answer}}</td>
               <td>
                <a href="{{ route('quiz.edit',$quiz->id)}}" class="btn btn-primary"><i class="fa fa-edit">&nbsp;</i> Edit</a>
                <form action="{{ route('quiz.destroy', $quiz->id)}}" method="post" class="d-inline" id="jsSubmitForm-{{ $quiz->id }}">  
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger jsConfirmButton" type="button" data-value="{{ $quiz->id }}"><i class="fa fa-trash">&nbsp;</i> Delete</button>
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