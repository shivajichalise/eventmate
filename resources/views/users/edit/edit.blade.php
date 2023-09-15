@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
<!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
<!-- /.content-header -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12 car-listing-steps">
                        <!-- Custom Tabs -->
                        <div class="stepwizard">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step {{ $step >= 1 ? ' active' : '' }}">
                                    <a href="{{ route('users.editForm', ['user'=>$user, 'step'=>'profile']) }}" type="button" class="btn btn-primary btn-circle">
                                        <span class="fas fa-user-circle"></span>
                                    </a>
                                    <p>Basic</p>
                                </div>
                                <div class="stepwizard-step {{ $step >= 2 ? ' active' : '' }}">
                                    <a href="{{ route('users.editForm', ['user'=>$user, 'step'=>'address']) }}" type="button" class="btn btn-primary btn-circle">
                                        <span class="fa fa-location-arrow"></span>
                                    </a>
                                    <p>Address</p>
                                </div>
                                <div class="stepwizard-step {{ $step >= 3 ? ' active' : '' }}">
                                    <a href="{{ route('users.editForm', ['user'=>$user, 'step'=>'contact']) }}" type="button" class="btn btn-primary btn-circle">
                                        <span class="fa fa-phone"></span>
                                    </a>
                                    <p>Contact</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('utils.flash_message')

            <div class="">
                <div class="tab-content" id="info-destination">
                    @yield('form-content')
                </div>
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
    top: 35px;
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

@section('plugins.Stepper', true)
