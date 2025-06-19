@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nickname --}}
        <div class="mb-3">
            <label for="nickname" class="form-label">Nickname</label>
            <input type="text" name="nickname" class="form-control @error('nickname') is-invalid @enderror" value="{{ old('nickname', $user->nickname) }}">
            @error('nickname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email', $user->email) }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">New Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control" >
        </div>

        {{-- Phone No --}}
        <div class="mb-3">
            <label for="phone_no" class="form-label">Phone No</label>
            <input type="text" name="phone_no" class="form-control @error('phone_no') is-invalid @enderror" value="{{ old('phone_no', $user->phone_no) }}">
            @error('phone_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- City --}}
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $user->city) }}">
            @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Avatar --}}
        <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
            @if($user->avatar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="100" height="100" class="rounded-circle">
                </div>
            @endif
            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
            @error('avatar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    <hr>

    {{-- Delete Account --}}
    <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Delete Account</button>
    </form>
</div>
@endsection
