@extends('adminlte::page')

@section('title', 'Results')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Results</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Results</li>
                <li class="breadcrumb-item active">Create</li>
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
                <h4><i class="fas fa-info-circle"></i> Select the appropriate event and sub-event for which you want to publish the result for.</h4>
                This section allows you to specify the event and sub-event for which you intend to publish the results. By selecting the correct options, you can ensure that the results are associated with the right event and sub-event, providing clarity and accuracy to your attendees.
            </div>

            @include('utils.flash_message')

            <form action="{{route('results.store')}}" method="post" enctype="multipart/form-data" name="">
                @csrf

                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="event"> Event <span class="text-danger">*</span></label>
                            <div>
                                <select class="form-control @error('event') is-invalid @enderror" name="event" id="event">
                                    <option selected disabled>Select event</option>
                                    @foreach ($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                    @endforeach
                                </select>

                                @error('event')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sub_event"> Sub-event <span class="text-danger">*</span></label>
                            <div>
                                <select class="form-control @error('sub_event_id') is-invalid @enderror" name="sub_event" id="sub_event">
                                    <option selected disabled>Select sub-event</option>
                                </select>

                                @error('sub_event')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description"> Description </label>
                            <div>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" id="description"></textarea>
                                @error('description')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file"> File (PDF/DOCX/EXCEL) </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="file"><i class="fa-solid fa-file"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" name="file" aria-describedby="file">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                    </div>
                                </div>
                                <small>
                                    Only pdf, word or excel files are allowed.
                                </small>

                                @error('file')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body" align="right">
                                <input type="submit" class="btn btn-primary btn-md" id="submit" value="Publish" />
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
$(document).ready(function () {
    bsCustomFileInput.init()

    let eventsData = @json($events);

    let eventDropdown = $('#event');
    let subeventDropdown = $('#sub_event');

    // Function to populate subevent dropdown
    function populateSubeventDropdown(selectedEventId) {
        subeventDropdown.empty().append('<option selected disabled>Select a sub-event</option>');

        if (selectedEventId) {
            // Find the selected event from the JSON data
            let selectedEvent = eventsData.find(function (event) {
                return event.id == selectedEventId;
            });

            // Populate the subevent dropdown with subevents of the selected event
            $.each(selectedEvent.sub_events, function (index, subevent) {
                subeventDropdown.append($('<option>', {
                    value: subevent.id,
                    text: subevent.name
                }));
            });

            // Enable the subevent dropdown
            subeventDropdown.prop('disabled', false);
        } else {
            // Disable the subevent dropdown if no event is selected
            subeventDropdown.prop('disabled', true);
        }
    }

    // Event listener for when an event is selected
    eventDropdown.on('change', function () {
        let selectedEventId = eventDropdown.val();
        populateSubeventDropdown(selectedEventId);
    });

    // Initial population when the page loads
    let initialSelectedEventId = eventDropdown.val();
    populateSubeventDropdown(initialSelectedEventId);
});
</script>
@endsection

@section('plugins.BsCustomFileInput', true)
