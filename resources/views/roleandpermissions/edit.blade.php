@extends('adminlte::page')

@section('title', 'Edit Role')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit Role</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/organizers">Home</a></li>
                <li class="breadcrumb-item">Role</li>
                <li class="breadcrumb-item active">{{ $role->name }}</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <form class="form-horizontal" action="{{ route('roles.update', ['role' => $role]) }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">

                <div class="form-group row">
                    <div class="col-sm-12">

                        <div class="form-group">
                            <label for="" class=""> Guard <span class="text-danger"> * </span></label>

                            <div class="">
                                <select class="form-control @error('guard_name') is-invalid @enderror" name="guard_name" id="guard_name">
                                    <option disabled>Select Guard Name</option>
                                    <option value="web" @if($role->guard_name == 'web') selected @endif>Web (Attendees)</option>
                                    <option value="organizer" @if($role->guard_name == 'organizer') selected @endif>Organizer</option>
                                </select>

                                @error('guard_name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class=""> Name <span class="text-danger"> * </span></label>
                            <div class="">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="" name="name" placeholder="Name" value="{{ old('name') ? old('name') : $role->name }}">
                                    @error('name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class=""> Permissions <span class="text-danger"> * </span></label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                <div class="col"><input type="checkbox" name="permissions[]" value="{{$permission->name}}" @if($role->hasPermissionTo($permission->name)) checked @endif /> {{$permission->name}}</div>
                                    @endforeach
                                    <div class="w-100"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="box-profile">
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    @stop
