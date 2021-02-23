@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
<link href="{{asset('css/app.css')}}" rel="stylesheet" />
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
                <th width="20%"></th>
                <th width="20%">Words</th>
                <th width="20%">Recall</th>
                <th width="20%">Words</th>
                <th width="20%">Recall</th>
                </tr>
            </thead>
            <tfoot>
              <tr align="center">
                <th width="20%"></th>
                <th width="20%">Contextual</th>
                <th width="20%">Categorical</th>
                <th width="20%">Contextual</th>
                <th width="20%">Categorical</th>
              </tr>
              <tr align="center">
                <th>Word</th>
                <th colspan="2">Round 1</th>
                <th colspan="2">Round 2</th>
              </tr>
            </tfoot>

            <tbody>
              @if(count($roundOneReport))
              <tr>
                <td>Recall Words {{ $roundOneReport->count() }}</td>
                <td>{!! $recallReport[0]['words'] !!}</td>
                <td>Remember: {{ $recallReport[0]['found_count'] }} Forgot: {{ $recallReport[0]['unfound_count']  }}</td>
                @if (count($roundTwoReport))
                <td>{!! $recallReport[1]['words'] !!}</td>
                <td>Remember: {{ $recallReport[1]['found_count'] }} Forgot: {{ $recallReport[1]['unfound_count']  }}</td>
                @else
                <td></td>
                <td></td>
                @endif
              </tr>
              <thead>
              <tr align="center">
                <th width="20%"></th>
                <th width="20%">Contextual</th>
                <th width="20%">Categorical</th>
                <th width="20%">Contextual</th>
                <th width="20%">Categorical</th>
                </tr>
              </thead>
              @foreach($storyWords as $storyWord)
                <tr>
                  <td>{{$storyWord->word}}</td>
                  @if(isset($roundOneReport[$storyWord->id][0]))
                  <td class="type text-center {{ $roundOneReport[$storyWord->id] && $roundOneReport[$storyWord->id][0]->correct_or_wrong ? 'correct' : 'wrong' }}"> 
                    @if($roundOneReport[$storyWord->id][0]->correct_or_wrong)
                      <i class="fa fa-check" aria-hidden="true"> </i>
                    @else 
                      <i class="fa fa-times" aria-hidden="true"> </i>
                    @endif
                    {{$roundOneReport[$storyWord->id][0]->answer}} ({{ $roundOneReport[$storyWord->id][0]->time_taken}} sec)
                  </td>
                  @else
                     <td class="type text-center"></td>
                  @endif
                  @if(isset($roundOneReport[$storyWord->id][1]))
                    <td class="type text-center categorical {{ $roundOneReport[$storyWord->id][1]->correct_or_wrong ? 'correct' : 'wrong' }}">
                      @if($roundOneReport[$storyWord->id][1]->correct_or_wrong)
                        <i class="fa fa-check" aria-hidden="true"> </i>
                      @else 
                        <i class="fa fa-times" aria-hidden="true"> </i>
                      @endif
                        {{ $roundOneReport[$storyWord->id][1]->answer ?: '' }} 
                        ({{{ $roundOneReport[$storyWord->id][1]->time_taken or ''}}} sec)
                    </td> 
                  @else
                   <td></td>
                  @endif
                  @if (count($roundTwoReport))
                    @if (isset($roundTwoReport[$storyWord->id])) 
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
                              {{$roundTwoReport[$storyWord->id][1]->answer ?: ''}} ({{$roundTwoReport[$storyWord->id][1]->time_taken}}sec)
                          </td> 
                        @else
                          <td class="type text-center categorical"></td>
                        @endif
                      @else
                      <td></td>
                      <td></td>
                    @endif
                    @else
                    <td></td>
                    <td></td>
                  @endif
                </tr>
              @endforeach
              <tr>
                <th>Total</th>
                @if(count($roundOneReport))
                  <th>Time taken : {{ $roundOneTotal['contextual'] }}</th>
                  <th>Time taken : {{ $roundOneTotal['categorical'] }}</th>
                @endif
                @if(count($roundTwoTotal))
                  <th>Time taken : {{ $roundTwoTotal['contextual'] }}</th>
                  <th>Time taken : {{ $roundTwoTotal['categorical'] }}</th>
                @else
                  <th></th>
                  <th></th>
                @endif
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection