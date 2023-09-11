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
                <li class="breadcrumb-item active">Users</li>
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
                Manage Users
            </h3>
            <div class="card-tools">
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
