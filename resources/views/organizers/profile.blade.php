@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/organizers">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
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
                <h4><i class="fas fa-info-circle"></i> Update your profile</h4>
                This section allows you to update your profile information.
            </div>

            @include('utils.flash_message')

            <form action="{{route('organizers.profile.update')}}" method="post" name="">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name"> Name <span class="text-danger">*</span></label>
                            <div>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" id="name" value="{{ $organizer->name }}" />
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email"> Email <span class="text-danger">*</span></label>
                            <div>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="email" id="email" value="{{ $organizer->email }}" />
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card-body" align="right">
                                    <input type="submit" class="btn btn-primary btn-md" id="submit" value="Update" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-md-10 offset-md-1">

            <div class="callout callout-info">
                <h4><i class="fas fa-info-circle"></i> Change your password</h4>
                This section allows you to change your password.
            </div>


            <form action="{{route('organizers.profile.update.password')}}" method="post" name="">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="current_password"> Current password <span class="text-danger">*</span></label>
                            <div>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="Current password" id="current_password" />
                                @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_password"> New password <span class="text-danger">*</span></label>
                            <div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="New password" id="password" />
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation"> Confirm password <span class="text-danger">*</span></label>
                            <div>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm password" id="password_confirmation" />
                                @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card-body" align="right">
                                    <input type="submit" class="btn btn-primary btn-md" id="submit" value="Update" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@stop
