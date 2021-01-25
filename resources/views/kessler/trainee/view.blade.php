@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
<link href="{{asset('css/app.css')}}" rel="stylesheet" />
<main>
  <div class="container-fluid">
    <h1 class="mt-4">Trainee Report</h1>
    <div class="card mb-4">
    <div class="card-body">
      View the report of the trainee during there session
    </div>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i>
          Trainee Report
      </div>
      <br>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr align="center">
                <th>Word</th>
                <th colspan="2">Round 1</th>
                <th colspan="2">Round 2</th>
                </tr>
                <tr align="center">
                <th width="25%"></th>
                <th width="25%">Contextual</th>
                <th width="25%">Categorical</th>
                <th width="25%">Contextual</th>
                <th width="25%">Categorical</th>
                </tr>
            </thead>
            <tfoot>
              <tr align="center">
                <th width="25%"></th>
                <th width="25%">Contextual</th>
                <th width="25%">Categorical</th>
                <th width="25%">Contextual</th>
                <th width="25%">Categorical</th>
              </tr>
              <tr align="center">
                <th>Word</th>
                <th colspan="2">Round 1</th>
                <th colspan="2">Round 2</th>
              </tr>
            </tfoot>
            <tbody>
              @if($roundOneReport->count())
              @foreach($storyWords as $storyWord)
                <tr>
                  <td>{{$storyWord->word}}</td>
                  <td class="type text-center {{ $roundOneReport[$storyWord->id][0]->correct_or_wrong ? 'correct' : 'wrong' }}"> 
                    @if($roundOneReport[$storyWord->id][0]->correct_or_wrong)
                      <i class="fa fa-check" aria-hidden="true"> </i>
                    @else 
                      <i class="fa fa-times" aria-hidden="true"> </i>
                    @endif
                    {{$roundOneReport[$storyWord->id][0]->answer}} ({{ $roundOneReport[$storyWord->id][0]->time_taken}} sec)
                  </td>
                  @if(isset($roundOneReport[$storyWord->id][1]))
                    <td class="type text-center categorical {{ $roundOneReport[$storyWord->id][1]->correct_or_wrong ? 'correct' : 'wrong' }}">
                      @if($roundOneReport[$storyWord->id][1]->correct_or_wrong)
                        <i class="fa fa-check" aria-hidden="true"> </i>
                        @else 
                          <i class="fa fa-times" aria-hidden="true"> </i>
                      @endif
                        {{$roundOneReport[$storyWord->id][1]->answer}} ({{$roundOneReport[$storyWord->id][1]->time_taken}} sec)
                    </td> 
                  @else
                    <td class="type text-center categorical"></td>
                  @endif
                  @if ($roundTwoReport->count())
                    <td class="type text-center {{ $roundTwoReport[$storyWord->id][0]->correct_or_wrong ? 'correct' : 'wrong' }}"> 
                      @if($roundTwoReport[$storyWord->id][0]->correct_or_wrong)
                        <i class="fa fa-check" aria-hidden="true"> </i>
                        @else 
                          <i class="fa fa-times" aria-hidden="true"> </i>
                      @endif
                          {{$roundTwoReport[$storyWord->id][0]->answer}} ({{ $roundTwoReport[$storyWord->id][0]->time_taken}} sec)</td>
                      @if (isset($roundTwoReport[$storyWord->id][1]))
                        <td class="type text-center categorical {{ $roundTwoReport[$storyWord->id][1]->correct_or_wrong ? 'correct' : 'wrong' }}">
                          @if($roundTwoReport[$storyWord->id][1]->correct_or_wrong)
                            <i class="fa fa-check" aria-hidden="true"> </i>
                          @else 
                            <i class="fa fa-times" aria-hidden="true"> </i>
                          @endif
                            {{$roundTwoReport[$storyWord->id][1]->answer}} ({{$roundTwoReport[$storyWord->id][1]->time_taken}}sec)
                        </td> 
                      @else
                        <td class="type text-center categorical"></td>
                      @endif
                    @else
                    <td></td>
                    <td></td>
                  @endif
                </tr>
              @endforeach
              <tr>
                <th>Total</th>
                <th>Time taken : {{ $roundOneTotal['contextual'] }}</th>
                <th>Time taken : {{ $roundOneTotal['categorical'] }}</th>
                <th>Time taken : {{ $roundTwoTotal['contextual'] }}</th>
                <th>Time taken : {{ $roundTwoTotal['categorical'] }}</th>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection