@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">

    <div class="row">

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$totalEvents}}</h3>
                    <p>Total Events</p>
                </div>
                <div class="icon">
                    <i class="fa-regular fa-calendar-days"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$totalUsers}}</h3>
                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$totalTicketsSold}}</h3>
                    <p>Total Ticket Sold</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-ticket"></i>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Rs {{$totalRevenue}}</h3>
                    <p>Total Revenue</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-coins"></i>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nationality Distribution Bar Chart</h3>
    </div>
    <div class="card-body">
        <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 422px;" width="844" height="500" class="chartjs-render-monitor"></canvas>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">User Growth</h3>
    </div>
    <div class="card-body">
        <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 422px;" width="844" height="500" class="chartjs-render-monitor"></canvas>
        </div>
    </div>
</div>

@stop

@section('css')
@stop

@section('js')
<script>
var barChartData = @json($barChart);

// Get the canvas element and render the chart
var barCtx = document.getElementById("barChart").getContext("2d");
var barChart = new Chart(barCtx, {
    type: "bar", // Specify the chart type (bar, line, pie, etc.)
    data: barChartData,
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});

// Line Chart

var lineChartData = @json($lineChart);

var lineCtx = document.getElementById("lineChart").getContext("2d");
var lineChart = new Chart(lineCtx, {
    type: "line", // Specify the chart type (bar, line, pie, etc.)
    data: lineChartData,
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});
</script>
@stop

@section('plugins.Chartjs', true)
