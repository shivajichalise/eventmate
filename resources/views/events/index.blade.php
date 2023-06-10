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
                <li class="breadcrumb-item active">Events</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container">

    @include('utils.flash_message')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Manage Events
            </h3>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs m-0" id="new-user" href="{{route('events.create')}}">
                    <i class="fa-solid fa-plus"></i> Add
                </a>
            </div>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@stop

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

@section('plugins.Datatables', true)
