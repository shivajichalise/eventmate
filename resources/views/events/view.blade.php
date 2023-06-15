@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Events</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/organizers">Home</a></li>
                <li class="breadcrumb-item">Events</li>
                <li class="breadcrumb-item active">{{ $general->name }}</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
            <li class="nav-item"><a class="nav-link" href="#sub-events" data-toggle="tab">Sub-events</a></li>
            <li class="nav-item"><a class="nav-link" href="#tickets" data-toggle="tab">Tickets</a></li>
            <li class="nav-item"><a class="nav-link" href="#support" data-toggle="tab">Support</a></li>
            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">

            <div class="tab-pane active" id="general">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Event Start Date/Time</th>
                            <th>Event End Date/Time</th>
                            <th>Registration Start Date/Time</th>
                            <th>Registration End Date/Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-widget="expandable-table" aria-expanded="true">
                            <td>{{ $general->name }}</td>
                            <td>{{ $general->event_start}}</td>
                            <td>{{ $general->event_end}}</td>
                            <td>{{ $general->registration_start}}</td>
                            <td>{{ $general->registration_end}}</td>
                        </tr>
                        <tr class="expandable-body">
                            <td colspan="5">
                                <p style="display: none;">
                                    {{ $general->description }}
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="sub-events">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Event Start Date/Time</th>
                            <th>Event End Date/Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sub_events as $sub_event)
                        <tr>
                            <td>{{ $sub_event->sn }}</td>
                            <td>{{ $sub_event->name }}</td>
                            <td>{{ $sub_event->event_start}}</td>
                            <td>{{ $sub_event->event_end}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="tickets">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Code</th>
                            <th>Sub-event</th>
                            <th>Currency</th>
                            <th>Price</th>
                            <th>Tax</th>
                            <th>Limit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->sn }}</td>
                            <td>{{ $ticket->code }}</td>
                            <td>{{ $ticket->subEvent->name }}</td>
                            <td>{{ $ticket->currency}}</td>
                            <td>{{ $ticket->price}}</td>
                            <td>{{ $ticket->tax}}</td>
                            <td>{{ $ticket->limit}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="tickets">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Code</th>
                            <th>Sub-event</th>
                            <th>Currency</th>
                            <th>Price</th>
                            <th>Tax</th>
                            <th>Limit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->sn }}</td>
                            <td>{{ $ticket->code }}</td>
                            <td>{{ $ticket->subEvent->name }}</td>
                            <td>{{ $ticket->currency}}</td>
                            <td>{{ $ticket->price}}</td>
                            <td>{{ $ticket->tax}}</td>
                            <td>{{ $ticket->limit}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="support">
                <table class="table table-hover text-nowrap">
                    <tbody>
                        <tr>
                            <th>Email</th>
                            <td>{{$support->email}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{$support->phone}}</td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{$support->mobile}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{$support->address}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane" id="settings">
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="setEventStatus" data-id="{{ $general->id }}" {{ $general->status ? 'checked' : '' }} />
                        <label class="custom-control-label" for="setEventStatus">Are the details correct?</label>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@stop

@section('js')
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// Set event status Request.
$('#setEventStatus').on('click', function() {
    eventId = $(this).attr('data-id')
    $.ajax({
        url: "{{ route('events.toggle') }}",
        type: 'POST',
        data: {
            eventId,
        },
        success: function(data) {},
        error: function(xhr, ajaxOptions, thrownError) {}
    });
});
</script>
@stop
