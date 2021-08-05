@extends('kessler.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
<link href="{{asset('css/style.css')}}" rel="stylesheet" />
  <div class="container-fluid">
    <h1 class="mt-4">Trainee Graphical Report</h1>
    <!-- <div class="card mb-4">
    <div class="card-body">
      Trainee ID : &emsp; Session Number :
    </div>
    </div> -->
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table mr-1"></i> Trainee ID : {{ $traineeID }} &emsp; Session Number : {{ $sessionNumber }}
      <a href="{{ url('/trainee')}}" class="btn btn-primary float-right" role="button"><i class="fas fa-step-backward"></i> BACK</a>
      </div>
      <br>
      <div class="row">
      	<div class="col-lg-6">
	        <div class="card mb-4">
	            <div class="card-header">
	                <i class="fas fa-chart-pie mr-1"></i>
              @php
                  $sessionStartTime = json_decode($startTime);
                  $sessionEndTime = json_decode($endTime);
              @endphp
              Round One  <p>Start Time: {{ date('m/d/Y h:i a', strtotime($sessionStartTime->roundOne)) }}
	             &emsp; End Time: {{ date('m/d/Y h:i a', strtotime($sessionEndTime->roundOne)) }}</p>
	            </div>
	            <div class="card-body"><canvas id="jsPieChartOne" width="100%" height="50"></canvas></div>
	            <div class="card-footer small text-muted text-center">Time Taken : {{ $roundOneTotalTime }}</div>
	        </div>
	   	  </div>
        <div class="col-lg-6">
          <div class="card mb-4">
              <div class="card-header">
                  <i class="fas fa-chart-pie mr-1"></i>
              @php
                  $sessionStartTime = json_decode($startTime);
                  $sessionEndTime = json_decode($endTime);
              @endphp
              Round Two  <p>Start Time: {{ date('m/d/Y h:i a', strtotime($sessionStartTime->roundTwo)) }}
               &emsp; End Time: {{ date('m/d/Y h:i a', strtotime($sessionEndTime->roundTwo)) }}</p>
               
              </div>
              <div class="card-body"><canvas id="jsPieChartTwo" width="100%" height="50"></canvas></div>
              <div class="card-footer small text-muted text-center">Time Taken : {{ $roundTwoTotalTime }}</div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card mb-4">
              <div class="card-header">
                  <i class="fas fa-chart-pie mr-1"></i>
              @php
                  $sessionStartTime = json_decode($startTime);
                  $sessionEndTime = json_decode($endTime);
              @endphp
              Overall Report  <p>Start Time: {{ date('m/d/Y h:i a', strtotime($sessionStartTime->roundOne)) }}
               &emsp; End Time: {{ date('m/d/Y h:i a', strtotime($sessionEndTime->roundTwo)) }}</p>
              </div>
              <div class="card-body"><canvas id="jsPieChart" width="100%" height="50"></canvas></div>
              <div class="card-footer small text-muted text-center">Time Taken : {{ $overallTotalTime }}</div>
          </div>
        </div>
     </div>  
   </div>
</div>
<script type="text/javascript">



   $(document).ready( function() { // Wait until document is fully parsed
    var recallRoundOneCount = '{{ $recallRoundOneCount['found_count'] }}';
    var contextualRoundOneCount = '{{ $contextualRoundOneCount }}';
    var categoricalRoundOneCount = '{{ $categoricalRoundOneCount }}';
    var totalWordsCount = '{{ $totalWords }}';
    const barColors = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'];
    const borderColors = ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'];
    const barWidth = 1;
    const barDataLabels = { color: 'black', labels: {
                    render: 'value',
                    fontSize: 14,
                    fontStyle: 'bold',
                    fontColor: '#000'
                    }
                  }
    var ctx = $("#jsPieChartOne");
    var PieChartOne = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Recall", "Contextual", "Categorical"],
        datasets: [{
          label: 'Round 1',
          data: [recallRoundOneCount, contextualRoundOneCount, categoricalRoundOneCount],
          backgroundColor: barColors,
          borderColor: borderColors,
          borderWidth: barWidth,
        }],
      },
    options: {
        plugins: {
          datalabels: barDataLabels
        },
        scales: {
          yAxes: [{
            display: true,
            ticks: {
              beginAtZero: true,
              max: Math.abs(totalWordsCount)
            }
          }]
        }
      },
        
    });
    var recallRoundTwoCount = {{ $recallRoundTwoCount['found_count'] }};
    var contextualRoundTwoCount = {{ $contextualRoundTwoCount }};
    var categoricalRoundTwoCount = {{ $categoricalRoundTwoCount }};
    var ctx = $("#jsPieChartTwo");
    var PieChartTwo = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Recall", "Contextual", "Categorical"],
        datasets: [{
          label: 'Round 2',
          data: [recallRoundTwoCount, contextualRoundTwoCount, categoricalRoundTwoCount],
          backgroundColor: barColors,
          borderColor: borderColors,
          borderWidth: barWidth,
        }],
      },
      options: {
        plugins: {
          datalabels: barDataLabels
        },
        scales: {
          yAxes: [{
            display: true,
            ticks: {
              beginAtZero: true,
              max: Math.abs(totalWordsCount)
            }
          }]
        },
      }
    });
    var recallOverallCount = {{ $recallOverallCount }};
    var contextualOverallCount = {{ $contextualOverallCount }};
    var categoricalOverallCount = {{ $categoricalOverallCount }};
    var ctx = $("#jsPieChart");
    var PieChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels:  ["Recall", "Contextual", "Categorical"],
        datasets: [{
          label: 'Overall',
          data: [recallOverallCount, contextualOverallCount, categoricalOverallCount],
          backgroundColor: barColors,
          borderColor: borderColors,
          borderWidth: barWidth,
        }],
      },
    options: {
      plugins: {
                datalabels: barDataLabels
                }
            }
    });
  });
</script>
@endsection