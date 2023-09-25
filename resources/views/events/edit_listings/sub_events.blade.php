@extends('events.edit_steps')

@section('form-content')

<div class="container">

    @include('utils.flash_message')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Sub-events
            </h3>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>

</div>

<div class="callout callout-info">
    <h4><i class="fas fa-info-circle"></i> Create Sub-events </h4>
    Start creating your sub-events by adding the basic information about your sub-event. Most information will be shown to attendees on your sub-event page
</div>


<div class="card">
    <div class="card-body">
        <form action="{{route('events.sub_events.save')}}" method="post" name="">
            @csrf

            <div class="form-group">
                <label for="name"> Sub-event Name <span class="text-danger">*</span></label>
                <div>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Sub-event Name" value="{{ old('name') ?? ($general?->name ?? '') }}" />
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label> Sub-event Start Date & Time <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" name="event_start" id="" class="form-control @error('event_start') is-invalid @enderror inputDateTime" placeholder="Sub-event Start Date & Time" value="{{ old('event_end') ?? ($general?->event_end ?? '') }}" autocomplete="off" />
                        </div>
                        @error('event_start')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label> Sub-event End Date & Time <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" name="event_end" id="" class="form-control @error('event_end') is-invalid @enderror inputDateTime" placeholder="Sub-event End Date & Time" value="{{ old('event_end') ?? ($general?->event_end ?? '') }}" autocomplete="off" />
                        </div>
                        @error('event_end')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-12" align="right">
                    <input type="submit" class="btn btn-success btn-md " id="submit" value="Save" name="" />
                </div>

            </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-body" align="right">
        <a href="{{ route('events.edit.form', ['event' => $general, 'step' => 'tickets']) }}" type="button" class="btn btn-primary btn-md"> Continue </a>
    </div>
</div>


@stop

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

@section('plugins.Datatables', true)
@section('plugins.TempusDominusBs4', true)
