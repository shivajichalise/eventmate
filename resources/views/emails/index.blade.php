@extends('adminlte::page')

@section('title', 'Send Emails')

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Send Emails</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/organizers">Home</a></li>
        <li class="breadcrumb-item active">Send Emails</li>
      </ol>
    </div>
  </div>
</div>

@stop

@section('content')
<div class="container-fluid">
  <div class="callout callout-info">
    <h5><i class="fas fa-info"></i> Note:</h5>
    You can only bulk send emails once per day.
  </div>

  @include('utils.flash_message')

  <div class="row">

    <div class="col-md-6 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-success"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Ask to participate to an event</span>
          <span class="info-box-number">
            <a class="btn btn-info btn-xs m-0" href="{{ route('send_emails.participate') }}">
              <i class="fa-solid fa-paper-plane"></i> Send
            </a>
          </span>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-success"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Send Remainder for upcoming events.</span>
          <span class="info-box-number">
            <a class="btn btn-info btn-xs m-0" href="{{ route('send_emails.remainder') }}">
              <i class="fa-solid fa-paper-plane"></i> Send
            </a>
          </span>
        </div>
      </div>
    </div>

  </div>
</div>
@stop
