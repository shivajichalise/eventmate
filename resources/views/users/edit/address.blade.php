@extends('users.edit.edit')

@section('form-content')
<form action="{{ route('users.address.update', ['user' => $user]) }}" method="post" name="listing-address-form">
  @method('PUT')
  @csrf

  <div class="card">
    <div class="card-body">

        <div class="form-group">
          <label for="address_line_1">Address Line 1<span class="text-danger"> * </span></label>
          <input type="text" class="form-control @error('address_line_1') is-invalid @enderror" id="address_line_1" name="address_line_1" value="{{ $addressInfo->address_line_1 }}" placeholder="Address line 1" />

          @error('address_line_1')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="state">State<span class="text-danger"> * </span></label>
          <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ $addressInfo->state }}" placeholder="State" />

          @error('state')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="city">City<span class="text-danger"> * </span></label>
          <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ $addressInfo->city }}" placeholder="City" />

          @error('city')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="country">Country<span class="text-danger"> * </span></label>
          <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ $addressInfo->country }}" placeholder="Country" />

          @error('country')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

    </div>
  </div>

  <div class="card">
    <div class="card-body" align="right">
      <input type="submit" class="btn btn-primary btn-md" id="submit" value="Update" name="updateAddressInfo" />
    </div>
  </div>

</form>
@endsection

@section('js')
@endsection
