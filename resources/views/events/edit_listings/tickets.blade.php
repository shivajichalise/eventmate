@extends('events.edit_steps')

@section('form-content')

<div class="container">

    @include('utils.flash_message')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Tickets
            </h3>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>

</div>

<div class="callout callout-info">
    <h4><i class="fas fa-info-circle"></i> Create Tickets </h4>
    Start creating tickets for your sub-events by adding the basic information about your ticket. Most information will be shown to attendees on your tickets page
</div>


<div class="card">
    <div class="card-body">
        <form action="{{route('events.tickets.save')}}" method="post" name="">
            @csrf

            <div class="form-group">
                <label for="">Sub-event <span class="text-danger">*</span></label>
                <select class="form-control @error('sub_event') is-invalid @enderror" name="sub_event" id="">
                    <option selected disabled>Select Sub-event</option>
                    @foreach($sub_events as $sub_event)
                    <option value="{{$sub_event->id}}">{{$sub_event->name}}</option>
                    @endforeach
                </select>
                @error('sub_event')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="row">

                <div class="col-3">
                    <div class="form-group">
                        <label> Currency <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa-sharp fa-solid fa-money-bill"></i></div>
                            </div>
                            <select class="form-control @error('currency') is-invalid @enderror" name="currency" id="">
                                <option selected disabled>Select currency</option>
                                @foreach($currencies as $currency)
                                <option value="{{ $currency->iso->code }}">{{$currency->name}} ({{ $currency->iso->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        @error('currency')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-5">
                    <div class="form-group">
                        <label> Price <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa-sharp fa-solid fa-credit-card"></i></div>
                            </div>
                            <input type="text" name="price" id="" class="form-control @error('price') is-invalid @enderror" placeholder="Price" value="{{ old('price') }}" autocomplete="off" />
                        </div>
                        @error('price')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label> Tax <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa-sharp fa-solid fa-percent"></i></div>
                            </div>
                            <input type="text" name="tax" id="" class="form-control @error('tax') is-invalid @enderror" placeholder="Sub-event End Date & Time" value="{{ old('tax') }}" autocomplete="off" />
                        </div>
                        @error('tax')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label> Limit <span class="text-danger">*</span> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></div>
                    </div>
                    <input type="text" name="limit" id="" class="form-control @error('limit') is-invalid @enderror" placeholder="Limit" value="{{ old('limit') }}" autocomplete="off" />
                </div>
                <small>Once the limit is reached, this ticket will be marked as "Sold Out"</small>
                @error('limit')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-lg-12" align="right">
                <input type="submit" class="btn btn-success btn-md " id="submit" value="Save" name="" />
            </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-body" align="right">
        <a href="{{ route('events.edit.form', ['event' => $general, 'step' => 'support']) }}" type="button" class="btn btn-primary btn-md"> Continue </a>
    </div>
</div>


@stop

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

@section('plugins.Datatables', true)
@section('plugins.TempusDominusBs4', true)
