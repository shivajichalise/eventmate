@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/organizers">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">{{$user->name}}</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container">

    @include('utils.flash_message')

    <div class="row">
        <div class="col-md-3">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="/images/logo.png" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    <!-- <p class="text-muted text-center">Software Engineer</p> -->
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Total tickets bought</b> <a class="float-right">{{ $totalTicketsBought }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Has complete profile?</b>
                            <a class="float-right">
                                @if($hasCompleteProfile) <i class="fa-solid fa-circle-check text-success"></i> @else <i class="fa-solid fa-circle-xmark text-danger"></i> @endif
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Roles</b> <a class="float-right">{{ $assignedRoles }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Is disabled?</b>
                            <a class="float-right">
                                @if($user->is_disabled) Yes @else No @endif
                            </a>
                        </li>
                    </ul>
                    <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                </div>

            </div>


            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About User</h3>
                </div>

                <div class="card-body">
                    <strong><i class="fa-solid fa-envelope"></i> Email </strong>
                    <p class="text-muted">
                        {{ $user->email }}
                    </p>
                    <hr>
                    <strong><i class="fa-solid fa-venus-mars"></i> Gender </strong>
                    <p class="text-muted">{{ $user->gender }}</p>
                    <hr>
                    <strong><i class="fa-solid fa-map-location-dot"></i> Address </strong>
                    <p class="text-muted">
                        <span class="tag tag-danger">{{ $user->address_line_1 }}</span>,
                        <span class="tag tag-info">{{ $user->state }}</span>,
                        <span class="tag tag-success">{{ $user->city }}</span>,
                        <span class="tag tag-warning">{{ $user->country }}</span>,
                    </p>
                    <hr>
                    <strong><i class="fa-solid fa-phone"></i> Contact </strong>
                    <p class="text-muted">{{ $user->mobile_number }}, {{ $user->emergency_number }}</p>
                </div>

            </div>

        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#identity" data-toggle="tab">Identity</a></li>
                    </ul>
                </div>
                <div class="card-body">

                    <div class="tab-content">
                        <div class="tab-pane active" id="identity">
                            <div class="post">
                                <div class="row mb-3">

                                    <div class="col-sm-6">
                                        <img class="img-fluid" src="/images/photo.jpg" alt="Photo">
                                    </div>

                                    <div class="col-sm-6">
                                        <img class="img-fluid" src="/images/photo.jpg" alt="Photo">
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@stop
