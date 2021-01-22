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
                  <th width="30%"></th>
                  <th width="30%">Contextual</th>
                  <th width="30%">Categorical</th>
                  <th width="30%">Contextual</th>
                  <th width="30%">Categorical</th>
                  </tr>
              </thead>
              <tfoot>
                <tr align="center">
                  <th width="30%"></th>
                  <th width="30%">Contextual</th>
                  <th width="30%">Categorical</th>
                  <th width="30%">Contextual</th>
                  <th width="30%">Categorical</th>
                </tr>
                <tr align="center">
                  <th>Word</th>
                  <th colspan="2">Round 1</th>
                  <th colspan="2">Round 2</th>
                  </tr>
                  </tfoot>
                  <tbody>
                    @foreach($storyWords as $storyWord)
                      <tr>
                        <td>{{$storyWord->word}}</td>
                        <td class="type text-center {{ $aroundOneReport[$storyWord->id][0]->correct_or_wrong ? 'correct' : 'wrong' }}"> 
                        @if($aroundOneReport[$storyWord->id][0]->correct_or_wrong)
                        <i class="fa fa-check" aria-hidden="true"> </i>
                          @else 
                            <i class="fa fa-times" aria-hidden="true"> </i>
                        @endif
                        {{$aroundOneReport[$storyWord->id][0]->answer}}({{$aroundOneReport[$storyWord->id][0]->time_taken}}sec)</td>
                        @if(isset($aroundOneReport[$storyWord->id][1]))
                        <td class="type text-center categorical {{ $aroundOneReport[$storyWord->id][1]->correct_or_wrong ? 'correct' : 'wrong' }}">
                          @if($aroundOneReport[$storyWord->id][1]->correct_or_wrong)
                          <i class="fa fa-check" aria-hidden="true"> </i>
                            @else 
                              <i class="fa fa-times" aria-hidden="true"> </i>
                          @endif
                            {{$aroundOneReport[$storyWord->id][1]->answer}}({{$aroundOneReport[$storyWord->id][1]->time_taken}}sec)
                          </td> 
                            @else
                              <td class="type text-center categorical"></td>
                          @endif
                              <td class="type text-center {{ $aroundTwoReport[$storyWord->id][0]->correct_or_wrong ? 'correct' : 'wrong' }}"> 
                              @if($aroundTwoReport[$storyWord->id][0]->correct_or_wrong)
                                <i class="fa fa-check" aria-hidden="true"> </i>
                                @else 
                                  <i class="fa fa-times" aria-hidden="true"> </i>
                              @endif
                                  {{$aroundTwoReport[$storyWord->id][0]->answer}}({{$aroundTwoReport[$storyWord->id][0]->time_taken}}sec)</td>
                              @if(isset($aroundTwoReport[$storyWord->id][1]))
                              <td class="type text-center categorical {{ $aroundTwoReport[$storyWord->id][1]->correct_or_wrong ? 'correct' : 'wrong' }}">
                              @if($aroundTwoReport[$storyWord->id][1]->correct_or_wrong)
                                <i class="fa fa-check" aria-hidden="true"> </i>
                              @else 
                                <i class="fa fa-times" aria-hidden="true"> </i>
                              @endif
                                {{$aroundTwoReport[$storyWord->id][1]->answer}}({{$aroundTwoReport[$storyWord->id][1]->time_taken}}sec)
                              </td> 
                                @else
                              <td class="type text-center categorical"></td>
                              @endif
                          </tr>
                          @endforeach
                          </tbody>
                  </table>
              </div>
          </div>
      </div>
    </div>
</main>
@endsection