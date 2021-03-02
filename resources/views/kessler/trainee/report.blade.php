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
	            Round One
	            </div>
	            <div class="card-body"><canvas id="jsPieChartOne" width="100%" height="50"></canvas></div>
	            <div class="card-footer small text-muted text-center">Time Taken : {{ $roundOneTotalTime }}</div>
	        </div>
	   	  </div>
        <div class="col-lg-6">
          <div class="card mb-4">
              <div class="card-header">
                  <i class="fas fa-chart-pie mr-1"></i>
              Round Two
              </div>
              <div class="card-body"><canvas id="jsPieChartTwo" width="100%" height="50"></canvas></div>
              <div class="card-footer small text-muted text-center">Time Taken : {{ $roundTwoTotalTime }}</div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card mb-4">
              <div class="card-header">
                  <i class="fas fa-chart-pie mr-1"></i>
              Overall Report
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
    var recallRoundOneCount = {{ $recallRoundOneCount['found_count'] }};
    var contextualRoundOneCount = {{ $contextualRoundOneCount }};
    var categoricalRoundOneCount = {{ $categoricalRoundOneCount }};
    var ctx = $("#jsPieChartOne");
    var PieChartOne = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["Recall", "Contextual", "Categorical"],
        datasets: [{
          data: [recallRoundOneCount, contextualRoundOneCount, categoricalRoundOneCount],
          backgroundColor: ['#dc3545', '#ffc107', '#28a745'],
        }],
      },
    options: {
        plugins: {
            datalabels: {
                color: 'black',
                labels: {
                    render: 'value',
                    fontSize: 42,
                    fontStyle: 'bold',
                    fontColor: '#000',
                    fontFamily: '"Lucida Console", Monaco, monospace'
                    }
                  }
                }
            }
    });
    var recallRoundTwoCount = {{ $recallRoundTwoCount['found_count'] }};
    var contextualRoundTwoCount = {{ $contextualRoundTwoCount }};
    var categoricalRoundTwoCount = {{ $categoricalRoundTwoCount }};
    var ctx = $("#jsPieChartTwo");
    var PieChartTwo = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["Recall", "Contextual", "Categorical"],
        datasets: [{
          data: [recallRoundTwoCount, contextualRoundTwoCount, categoricalRoundTwoCount],
          backgroundColor: ['#dc3545', '#ffc107', '#28a745'],
        }],
      },
    options: {
        plugins: {
            datalabels: {
                color: 'black',
                labels: {
                    render: 'value',
                    fontSize: 42,
                    fontStyle: 'bold',
                    fontColor: '#000',
                    fontFamily: '"Lucida Console", Monaco, monospace'
                    }
                  }
                }
            }
    });
    var recallOverallCount = {{ $recallOverallCount }};
    var contextualOverallCount = {{ $contextualOverallCount }};
    var categoricalOverallCount = {{ $categoricalOverallCount }};
    var ctx = $("#jsPieChart");
    var PieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels:  ["Recall", "Contextual", "Categorical"],
        datasets: [{
          data: [recallOverallCount, contextualOverallCount, categoricalOverallCount],
          backgroundColor: ['#dc3545', '#ffc107', '#28a745'],
        }],
      },
    options: {
      plugins: {
                datalabels: {
                color: 'black',
                labels: {
                    render: 'value',
                    fontSize: 42,
                    fontStyle: 'bold',
                    fontColor: '#000',
                    fontFamily: '"Lucida Console", Monaco, monospace'
                    }
                  }
                }
            }
    });
  });
</script>
@endsection