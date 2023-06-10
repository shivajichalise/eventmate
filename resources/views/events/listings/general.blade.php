@extends('events.steps')

@section('form-content')

<div class="callout callout-info">
    <h4><i class="fas fa-info-circle"></i> Basic information</h4>
    Start creating your event page by adding the basic information about your event. Most information will be shown to attendees on your event page
</div>

@include('utils.flash_message')

<form action="{{route('events.general.save')}}" method="post" name="">
    @csrf

    <div class="card">
        <div class="card-body">

            <div class="form-group">
                <label for="name"> Name <span class="text-danger">*</span></label>
                <div>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Event Name" value="{{ old('name') ?? ($general?->name ?? '') }}" />
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description"> Event Description </label>
                <div>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" id="description">{{old('description')}}</textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label> Event Start Date & Time <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" name="event_start" id="" class="form-control @error('event_start') is-invalid @enderror inputDateTime" placeholder="Event Start Date & Time" value="{{ old('event_end') ?? ($general?->event_end ?? '') }}" autocomplete="off" />
                        </div>
                        @error('event_start')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label> Event End Date & Time <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" name="event_end" id="" class="form-control @error('event_end') is-invalid @enderror inputDateTime" placeholder="Event End Date & Time" value="{{ old('event_end') ?? ($general?->event_end ?? '') }}" autocomplete="off" />
                        </div>
                        @error('event_end')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label> Registration Start Date & Time <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" name="registration_start" id="" class="form-control @error('registration_start') is-invalid @enderror inputDateTime" placeholder="Registration Start Date & Time" value="{{ old('registration_start') ?? ($general?->registration_start ?? '') }}" autocomplete="off" />
                        </div>
                        @error('registration_start')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label> Registration End Date & Time <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" name="registration_end" id="" class="form-control @error('registration_end') is-invalid @enderror inputDateTime" placeholder="Registration End Date & Time" value="{{ old('registration_end') ?? ($general?->registration_end ?? '') }}" autocomplete="off" />
                        </div>
                        @error('registration_end')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-body" align="right">
            <input type="submit" class="btn btn-primary btn-md " id="submit" value="Save & Continue" />
        </div>
    </div>

</form>

@stop

@section('plugins.TempusDominusBs4', true)
