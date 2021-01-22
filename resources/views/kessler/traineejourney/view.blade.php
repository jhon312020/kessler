@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <link href="{{asset('css/app.css')}}" rel="stylesheet" />
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Trainee Journey Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
 
             <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- solid sales graph -->
            <div class="card ">
              <div class="card-header border-0">
            <div class="row">
                <table class="table table-bordered table-hover report">
                  <thead>
                  <tr align="center">
                  <th>Word</th>
                  <th colspan="2">Round 1</th>
                  <th colspan="2">Round 2</th>
                  </tr>
                  <tr>
                    <tr align="center">
                  <th></th>
                  <th>Contextual</th>
                  <th>Categorical</th>
                  <th>Contextual</th>
                  <th>Categorical</th>
                  </tr>
                  </thead>
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
                  <tfoot>
                  <tr align="center">
                    <th></th>
                    <th>Contextual</th>
                    <th>Categorical</th>
                    <th>Contextual</th>
                    <th>Categorical</th>
                  </tr>
                  <tr>
                  <tr align="center">
                    <th>Word</th>
                    <th colspan="2">Round 1</th>
                    <th colspan="2">Round 2</th>
                  </tr>
                  </tfoot>
                </table>
            </div>
        <!-- /.row (main row) -->
      </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection