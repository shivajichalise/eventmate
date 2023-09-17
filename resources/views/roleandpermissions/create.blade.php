@extends('adminlte::page')

@section('title', 'Create Role')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Create Role</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/organizers">Home</a></li>
                <li class="breadcrumb-item">Create</li>
                <li class="breadcrumb-item active">Role</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-10 offset-md-1">

            <div class="callout callout-info">
                <h4><i class="fas fa-info-circle"></i> Create new role for your dashboard.</h4>
                This section allows you to create a new role for your dashboard app. Specify the guard name and role name very carefully.
            </div>

            <form action="{{route('roles.store')}}" method="post">
                @csrf

                <div class="card">
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-sm-12">

                                <div class="form-group">
                                    <label for="" class=""> Guard Name <span class="text-danger"> * </span></label>

                                    <div class="">
                                        <select class="form-control @error('guard_name') is-invalid @enderror" name="guard_name" id="guard_name">
                                            <option selected disabled>Select Guard Name</option>
                                            <option value="web">Web (Attendees)</option>
                                            <option value="organizer">Organizer</option>
                                        </select>

                                        @error('guard_name')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="" class=""> Name <span class="text-danger"> * </span></label>
                                    <div class="">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="">
                                        @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@stop
