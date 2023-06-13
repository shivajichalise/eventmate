@extends('adminlte::page')

@section('title', 'Events')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Events</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Events</li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12 car-listing-steps">
                        <div class="stepwizard">
                            <div class="stepwizard-row setup-panel">

                                <div class="stepwizard-step {{ $step >= 1 ? 'active' : '' }}">
                                    <a href="{{ route('events.form', ['step' => 'general']) }}" type="button" class="btn btn-primary btn-circle">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                    <p>General</p>
                                </div>

                                <div class="stepwizard-step {{ $step >= 2 ? 'active' : '' }}">
                                    <a href="{{ route('events.form', ['step' => 'sub-events']) }}" type="button" class="btn btn-primary btn-circle">
                                        <i class="fa-regular fa-calendar-plus"></i>
                                    </a>
                                    <p>Sub-event</p>
                                </div>

                                <div class="stepwizard-step {{ $step >= 3 ? 'active' : '' }}">
                                    <a href="{{ route('events.form', ['step' => 'tickets']) }}" type="button" class="btn btn-primary btn-circle">
                                        <i class="fa-solid fa-ticket"></i>
                                    </a>
                                    <p>Tickets</p>
                                </div>

                                <div class="stepwizard-step {{ $step >= 4 ? 'active' : '' }}">
                                    <a href="{{ route('events.form', ['step' => 'support']) }}" type="button" class="btn btn-primary btn-circle">
                                        <i class="fa-solid fa-info"></i>
                                    </a>
                                    <p>Support</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="info-destination">
                @yield('form-content')
            </div>

        </div>
    </div>
</div>

@stop

@section('css')
<style>
.stepwizard-step p {
    font-weight: bold;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 37px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}

.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}

.active .btn-circle {
    background-color: #367FA9;
    border: solid 3px #367fa9 !important;
}

.btn-circle {
    width: 46px;
    height: 46px;
    text-align: center;
    padding: 8px 0;
    font-size: 20px;
    line-height: 1.428571429;
    border-radius: 35px;
    margin-top: 12px;
    border: solid 3px #ccc !important;
    opacity: 1 !important;
    -webkit-box-shadow: inset 0px 0px 0px 3px #fff !important;
    -moz-box-shadow: inset 0px 0px 0px 3px #fff !important;
    -o-box-shadow: inset 0px 0px 0px 3px #fff !important;
    -ms-box-shadow: inset 0px 0px 0px 3px #fff !important;
    box-shadow: inset 0px 0px 0px 3px #fff !important;
    background-color: #ccc;
}

a.btn-circle:hover {
    border: solid 3px #367fa9 !important;
}

.car-listing-steps .stepwizard .glyphicon {
    color: #FFF;
}

.mainImage {
    background-color: #008fd4;
    color: #FFF;
}

.mainImage .main-button {
    color: #333
}
</style>
@stop
