@extends('users.edit.edit')

@section('form-content')
<form action="{{ route('users.contact.update', ['user' => $user]) }}" method="post" name="listing-contact-form">
  @method('PUT')
  @csrf

  <div class="card">
    <div class="card-body">

        <div class="form-group">
          <label for="mobile_number">Mobile number<span class="text-danger"> * </span></label>
          <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="mobile_number" name="mobile_number" value="{{ $contactInfo->mobile_number }}" placeholder="Mobile number" />

          @error('mobile_number')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="emergency_number">Emergency number<span class="text-danger"> * </span></label>
          <input type="text" class="form-control @error('emergency_number') is-invalid @enderror" id="emergency_number" name="emergency_number" value="{{ $contactInfo->emergency_number }}" placeholder="Emergency number" />

          @error('emergency_number')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

    </div>
  </div>

  <div class="card">
    <div class="card-body" align="right">
      <input type="submit" class="btn btn-primary btn-md" id="submit" value="Update" name="updateContactInfo" />
    </div>
  </div>

</form>
@endsection

@section('js')
@endsection
