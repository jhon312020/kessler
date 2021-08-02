@extends('kessler.layouts.master')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Quiz</h3></div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="post" action="{{ route('quiz.store') }}">
              @csrf
              <div class="form-group">
                <label class="small mb-1" for="session_number">Session Number</label>
                <select class="form-control select2" id="session_number" name="session_number" required placeholder="Select Session Number">
                  <option value='' selected="selected">Session Number</option>
                  @foreach($totalSessions as $session)
                    <option value="{{ $session }}">{{ $session }}</option>
                  @endforeach;
                </select>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="question">Enter Question</label>
                <input type="text" class="form-control py-4" id="question" name="question" placeholder="Enter Question" required>
              </div>
              <div class="form-group">
                <label class="small mb-1" for="one_word_answer">Enter One Word Answer</label>
                <input type="text" class="form-control py-4" id="one_word_answer" name="answer" placeholder="Enter One Word Answer" required> 
              </div>
                <div class="form-group">
                <label class="small mb-1" for="sentence_answer">Enter Sentence Answer</label>
                <input type="text" class="form-control py-4" id="sentence_answer" name="sentence_answer" placeholder="Enter Sentence Answer" required>
              </div>
              <div class="form-group d-flex align-items-center float-right mt-4 mb-0">
                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ url('/quiz')}}" class="ml-2 btn btn-danger" role="button">Cancel</a>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
