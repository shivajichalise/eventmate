@extends('users.edit.edit')

@section('form-content')
<form action="{{ route('users.profile.update', ['user' => $user]) }}" method="post" name="listing-profile-form">
  @method('PUT')
  @csrf

  <div class="card">
    <div class="card-body">

        <div class="form-group">
          <label for="name">Name<span class="text-danger"> * </span></label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $profileInfo->name }}" placeholder="Profile line 1" />

          @error('name')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="email">Email<span class="text-danger"> * </span></label>
          <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $profileInfo->email }}" placeholder="Email" />

          @error('email')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="gender">Gender<span class="text-danger"> * </span></label>

          <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
            <option selected disabled>Select gender</option>
            <option value="Male" @if($profileInfo->gender == 'Male') selected @endif>Male</option>
            <option value="Female" @if($profileInfo->gender == 'Female') selected @endif>Female</option>
            <option value="Other" @if($profileInfo->gender == 'Other') selected @endif>Other</option>
          </select>

          @error('gender')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label for="is_disabled">Is disabled?<span class="text-danger"> * </span></label>

          <select class="form-control @error('is_disabled') is-invalid @enderror" name="is_disabled" id="is_disabled">
            <option selected disabled>Select is disabled</option>
            <option value="0" @if(!($profileInfo->is_disabled)) selected @endif>No</option>
            <option value="1" @if($profileInfo->is_disabled) selected @endif>Yes</option>
          </select>

          @error('is_disabled')
          <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>

    </div>
  </div>

  <div class="card">
    <div class="card-body" align="right">
      <input type="submit" class="btn btn-primary btn-md" id="submit" value="Update" name="updateProfileInfo" />
    </div>
  </div>

</form>
@endsection

@section('js')
@endsection
