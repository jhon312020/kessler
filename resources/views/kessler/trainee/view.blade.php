@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
<link href="{{asset('css/style.css')}}" rel="stylesheet" />
  <div class="container-fluid">
    <h1 class="mt-4">Trainee Report</h1>
    <!-- <div class="card mb-4">
    <div class="card-body">
       Trainee ID: &emsp; Session Number :
    </div>
    </div> -->
    <div class="card mb-4">
      <div class="card-header">
<!--    <i class="fas fa-table mr-1"></i> Trainee Report <br> -->
        <i class="fas fa-table mr-1"></i> Trainee ID : {{ $traineeID }} &emsp; Session Number : {{ $sessionNumber }}
      <a href="{{ url('/trainee')}}" class="btn btn-primary float-right" role="button"><i class="fas fa-step-backward"></i> BACK</a>
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
                {{-- <td>Recall Words {{ $roundOneReport->count() }}</td> --}}
                <td>Recall Words {{ $storyWords->count() }}</td>
                <td>{!! $recallReport[0]['words'] !!}</td>
                <td>Remember: {{ $recallReport[0]['found_count'] }} <br> Forgot: {{ $recallReport[0]['unfound_count']  }}</td>
                @if (count($roundTwoReport))
                <td>{!! $recallReport[1]['words'] !!}</td>
                <td>Remember: {{ $recallReport[1]['found_count'] }} <br> Forgot: {{ $recallReport[1]['unfound_count']  }}</td>
                @else
                <td></td>
                <td></td>
                @endif
              </tr>
              @if (count($traineeStories)) 
              <tr>
                <td>Story</td>
                <td colspan="2">
                  @if (count($traineeStories)) 
                    {{ $traineeStories[0]['updated_story'] }}
                  @endif
                </td>
                <td colspan="2">
                  @if (count($traineeStories) > 1) 
                    {{ $traineeStories[1]['updated_story'] }}
                  @endif
                </td>
              </tr>
              @endif
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
                  <td class="type text-center {{ $roundOneReport[$storyWord->id] && $roundOneReport[$storyWord->id][0]['correct_or_wrong'] ? 'correct' : 'wrong' }}"> 
                    @if($roundOneReport[$storyWord->id][0]['correct_or_wrong'])
                      <i class="fa fa-check" aria-hidden="true"> </i>
                    @else 
                      <a href="#"  class="jsEditAnswer" data-transactionid="{{$roundOneReport[$storyWord->id][0]['id']}}" data-useranswer="{{ $roundOneReport[$storyWord->id][0]['answer'] }}" data-storyanswer="{{$storyWord->word}}" data-title="Edit Contextual Round 1"><i class="fa fa-edit" aria-hidden="true"></i></a> &nbsp;
                      <i class="fa fa-times" aria-hidden="true"> </i>

                    @endif
                    {{$roundOneReport[$storyWord->id][0]['answer']}} ({{ $roundOneReport[$storyWord->id][0]['time_taken']}} sec)
                  </td>
                  @else
                     <td class="type text-center"></td>
                  @endif
                  @if(isset($roundOneReport[$storyWord->id][1]))
                    <td class="type text-center categorical {{ $roundOneReport[$storyWord->id][1]['correct_or_wrong'] ? 'correct' : 'wrong' }}">
                      @if($roundOneReport[$storyWord->id][1]['correct_or_wrong'])
                        <i class="fa fa-check" aria-hidden="true"> </i>
                      @else
                        <a href="#"  class="jsEditAnswer" data-transactionid="{{$roundOneReport[$storyWord->id][1]['id']}}" data-useranswer="{{ $roundOneReport[$storyWord->id][1]['answer'] }}" data-storyanswer="{{$storyWord->word}}" data-title="Edit Categorical Round 1">
                          <i class="fa fa-edit" aria-hidden="true"></i></a> &nbsp; 
                        <i class="fa fa-times" aria-hidden="true"> </i>
                      @endif
                        {{ $roundOneReport[$storyWord->id][1]['answer'] ?: '' }} 
                        ({{ $roundOneReport[$storyWord->id][1]['time_taken'] ?: ''}} sec)
                    </td> 
                  @else
                   <td></td>
                  @endif
                  @if (count($roundTwoReport))
                    @if (isset($roundTwoReport[$storyWord->id])) 
                      <td class="type text-center {{ $roundTwoReport[$storyWord->id][0]['correct_or_wrong'] ? 'correct' : 'wrong' }}"> 
                        @if($roundTwoReport[$storyWord->id][0]['correct_or_wrong'])
                          <i class="fa fa-check" aria-hidden="true"> </i>
                          @else
                            <a href="#"  class="jsEditAnswer" data-transactionid="{{$roundTwoReport[$storyWord->id][0]['id']}}" data-useranswer="{{ $roundTwoReport[$storyWord->id][0]['answer'] }}" data-storyanswer="{{$storyWord->word}}" data-title="Edit Contextual Round 2">
                            <i class="fa fa-edit" aria-hidden="true"></i></a> &nbsp; 
                            <i class="fa fa-times" aria-hidden="true"> </i>
                        @endif
                            {{$roundTwoReport[$storyWord->id][0]['answer']}} ({{ $roundTwoReport[$storyWord->id][0]['time_taken']}} sec)</td>
                        @if (isset($roundTwoReport[$storyWord->id][1]))
                          <td class="type text-center categorical {{ $roundTwoReport[$storyWord->id][1]['correct_or_wrong'] ? 'correct' : 'wrong' }}">
                            @if($roundTwoReport[$storyWord->id][1]['correct_or_wrong'])
                              <i class="fa fa-check" aria-hidden="true"> </i>
                            @else 
                              <a href="#"  class="jsEditAnswer" data-transactionid="{{$roundTwoReport[$storyWord->id][1]['id']}}" data-useranswer="{{ $roundTwoReport[$storyWord->id][1]['answer'] }}" data-storyanswer="{{$storyWord->word}}" data-title="Edit Categorical Round 2">
                              <i class="fa fa-edit" aria-hidden="true"></i></a> &nbsp;
                              <i class="fa fa-times" aria-hidden="true"> </i>
                            @endif
                              {{$roundTwoReport[$storyWord->id][1]['answer'] ?: ''}} ({{$roundTwoReport[$storyWord->id][1]['time_taken']}}sec)
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
                <th>Total Time</th>
                @if(count($roundOneReport))
                  <th class="text-center">{{ $roundOneTotal['contextual'] }}</th>
                  <th class="text-center">{{ $roundOneTotal['categorical'] }}</th>
                @endif
                @if(count($roundTwoTotal))
                  <th class="text-center">{{ $roundTwoTotal['contextual'] }}</th>
                  <th class="text-center">{{ $roundTwoTotal['categorical'] }}</th>
                @else
                  <th></th>
                  <th></th>
                @endif
              </tr>
              <tr>
                <th>Overall Time</th>
                <th class="text-center" colspan="2">{{ $roundOneTimeTaken }}</th>
                <th class="text-center" colspan="2">{{ $roundTwoTimeTaken }}</th>
              </tr>
              <tr>
                <th>Session Total Time</th>
                <th class="text-center" colspan="4">{{ $sessionTime }}</th>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @include('common.modal')
  <script type='text/javascript'>
    var recordID = '';
    var userAnswer = '';
    var storyAnswer = '';
    var title = '';
    $(document).ready( function() { // Wait until document is fully parsed
    $(document).on('click touchstart', ".jsEditAnswer", function(event) {
      event.preventDefault();
      recordID = $(this).data('transactionid');
      userAnswer = $(this).data('useranswer');
      storyAnswer = $(this).data('storyanswer');
      title = $(this).data('title');
      $('#jsModalTitle').text(title);
      $('#jsStoryAnswer').text(storyAnswer);
      $('#jsUserAnswer').attr('name', 'answer-'+recordID);
      $('#jsUserAnswer').val(userAnswer);
      $('#editAnswerModal').modal('show');
    });
  });
  </script>
@endsection