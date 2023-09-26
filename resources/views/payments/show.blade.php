@extends('adminlte::page')

@section('title', 'Payment')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Payment</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/organizers">Home</a></li>
                <li class="breadcrumb-item">Payment</li>
                <li class="breadcrumb-item active">{{$invoice->number}}</li>
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
                        <img class="profile-user-img img-fluid img-circle" src="/images/male_avatar.png" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                </div>

            </div>

        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payment Details</h3>
                    <div class="card-tools">
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Title</th>
                                <th>Value</th>
                            </tr>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($data as $key => $value)
                            <tr>
                                <td>{{ $i }}.</td>
                                <td>{{ $key }}</td>
                                <td>{{ $value }}</td>
                            </tr>

                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
@stop
