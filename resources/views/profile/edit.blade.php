@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Profile</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nickname -->
                        <div class="mb-3">
                            <label for="nickname" class="form-label">Nickname</label>
                            <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old('nickname', Auth::user()->nickname) }}">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}">
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone No</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                        </div>

                        <!-- City -->
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', Auth::user()->city) }}">
                        </div>

                        <!-- Avatar -->
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>

                        <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger float-end">Delete Account</button>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
