@extends('events.steps')

@section('form-content')

<div class="callout callout-info">
    <h4><i class="fas fa-info-circle"></i> Support contact</h4>
    Finish creating your event by adding the support contact information about your event. Most information will be shown to attendees on your event page
</div>

@include('utils.flash_message')

<form action="{{route('events.support.save')}}" method="post" name="">
    @csrf

    <div class="card">
        <div class="card-body">

            <div class="form-group">
                <label for="name"> Email <span class="text-danger">*</span></label>
                <div>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Support email" value="{{ old('email') ?? ($support['email'] ?? '') }}" />
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label> Phone </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa-sharp fa-solid fa-phone"></i></div>
                            </div>
                            <input type="text" name="phone" id="" class="form-control @error('phone') is-invalid @enderror" placeholder="Landline" value="{{ old('phone') ?? ($support['phone'] ?? '') }}" autocomplete="off" />
                        </div>
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label> Mobile <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa-sharp fa-solid fa-mobile"></i></div>
                            </div>
                            <input type="text" name="mobile" id="" class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile number" value="{{ old('mobile') ?? ($support['mobile'] ?? '') }}" autocomplete="off" />
                        </div>
                        @error('mobile')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label> Address <span class="text-danger">*</span> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-sharp fa-solid fa-mobile"></i></div>
                    </div>
                    <input type="text" name="address" id="" class="form-control @error('address') is-invalid @enderror" placeholder="Address" value="{{ old('address') ?? ($support['address'] ?? '') }}" autocomplete="off" />
                </div>
                @error('address')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-body" align="right">
            <input type="submit" class="btn btn-primary btn-md " id="submit" value="Save" />
        </div>
    </div>

</form>

@stop
