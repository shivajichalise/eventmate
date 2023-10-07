@extends('events.steps')

@section('form-content')

<div class="callout callout-info">
    <h4><i class="fas fa-info-circle"></i> Basic information</h4>
    Start creating your event page by adding the basic information about your event. Most information will be shown to attendees on your event page
</div>

@include('utils.flash_message')

<form action="{{route('events.general.save')}}" method="post" enctype="multipart/form-data" name="">
    @csrf

    <div class="card">
        <div class="card-body">

            <div class="form-group">
                <label for="name"> Name <span class="text-danger">*</span></label>
                <div>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Event Name" value="{{ old('name') ?? ($general['name'] ?? '') }}" />
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description"> Event Description </label>
                <div>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" id="description">{{ old('description') ?? ($general['description'] ?? '') }}</textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="address">Venue: <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" placeholder="Venue" id="searchTextField" value="{{ old('venue') ?? ($general['venue']->address ?? '') }}" />
                <input type="hidden" id="country" name="country" value="{{ old('country') ?? ($general['venue']->country ?? '') }}" />
                <input type="hidden" id="city" name="city" value="{{ old('city') ?? ($general['venue']->city ?? '') }}" />
                <input type="hidden" id="state" name="state" value="{{ old('state') ?? ($general['venue']->state ?? '') }}" />
                <input type="hidden" id="lat" name="lat" value="{{ old('lat') ?? ($general['venue']->lat ?? '') }}" />
                <input type="hidden" id="lng" name="lng" value="{{ old('lng') ?? ($general['venue']->lng ?? '') }}" />
                @error('venue')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <div id="map-canvas" class="col-lg-12">
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
                            <input type="text" name="event_start" id="" class="form-control @error('event_start') is-invalid @enderror inputDateTime" placeholder="Event Start Date & Time" value="{{ old('event_start') ?? ( $general ? \Carbon\Carbon::parse($general['event_start'])->format('m/d/Y H:i A') : '') }}" autocomplete="off" />
                        </div>
                        <small class="text-muted">eg. 11/10/2023 7:00 PM</small>
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
                            <input type="text" name="event_end" id="" class="form-control @error('event_end') is-invalid @enderror inputDateTime" placeholder="Event End Date & Time" value="{{ old('event_end') ?? ( $general ? \Carbon\Carbon::parse($general['event_end'])->format('m/d/Y H:i A') : '') }}" autocomplete="off" />
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
                            <input type="text" name="registration_start" id="" class="form-control @error('registration_start') is-invalid @enderror inputDateTime" placeholder="Registration Start Date & Time" value="{{ old('registration_start') ?? ( $general ?  \Carbon\Carbon::parse($general['registration_start'])->format('m/d/Y H:i A') : '') }}" autocomplete="off" />
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
                            <input type="text" name="registration_end" id="" class="form-control @error('registration_end') is-invalid @enderror inputDateTime" placeholder="Registration End Date & Time" value="{{ old('registration_end') ?? ( $general ? \Carbon\Carbon::parse($general['registration_end'])->format('m/d/Y H:i A') : '') }}" autocomplete="off" />
                        </div>
                        @error('registration_end')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>


            <div class="form-group">
                <label for="banner"> Banner Image (JPG/PNG) </label>
                <div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="banner"><i class="fa-solid fa-image"></i></span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('banner') is-invalid @enderror" id="banner" name="banner" aria-describedby="banner">
                            <label class="custom-file-label" for="banner">Choose image</label>
                        </div>
                    </div>
                    <small>
                        Only jpg and png images are allowed.
                    </small>

                    @error('banner')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="row">
            <div class="col-6">
                <div class="card-body" align="left">
                    <a href="{{ route('events.discard') }}" class="btn btn-secondary btn-md"> Discard </a>
                </div>
            </div>
            <div class="col-6">
                <div class="card-body" align="right">
                    <input type="submit" class="btn btn-primary btn-md" id="submit" value="Save & Continue" />
                </div>
            </div>
        </div>
    </div>

</form>

@stop

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhq4J5no2hsLTmXC7L_JBnoHDp0l_rrbE&libraries=places&callback=initAutocomplete" async defer></script>
<script>
bsCustomFileInput.init()
let autocomplete;

function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(document.getElementById('searchTextField'))
    autocomplete.addListener('place_changed', onPlaceChanged, {
        passive: true
    })
}

function onPlaceChanged() {
    var place = autocomplete.getPlace()
    if (!place.geometry || !place.geometry.location) {
        document.getElementById('searchTextField').addClass('is-invalid')
        return; // user did not select a prediction; reset input field
    } else {
        $('#map-canvas').show();
        $('#map-canvas').css("height", "200px");

        var address = placeToAddress(place);
        document.getElementById('city').value = address.City.long_name;
        document.getElementById('country').value = address.Country.long_name;
        document.getElementById('state').value = address.State.long_name;
        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();
        document.getElementById('map-canvas').style.display = "block";

        var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());

        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: latlng,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title: 'Set lat/lon values for this property',
            draggable: true
        });
    }
}
</script>
@endsection

@section('plugins.TempusDominusBs4', true)
@section('plugins.PlaceToAddress', true)
@section('plugins.BsCustomFileInput', true)
