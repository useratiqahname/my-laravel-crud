@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Multi-Factor Authentication</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('mfa.verify') }}">
        @csrf

        <div class="form-group">
            <label for="code">Enter the verification code sent to your email:</label>
            <input type="text" name="code" id="code" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Verify</button>
    </form>
</div>
@endsection
