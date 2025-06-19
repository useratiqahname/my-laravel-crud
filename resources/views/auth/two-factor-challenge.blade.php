@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Two-Factor Authentication</h2>

    <p>Please enter the 6-digit code from your authenticator app:</p>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ url('/two-factor-challenge') }}">
        @csrf

        <div class="form-group">
            <label for="code">Authentication Code</label>
            <input type="text" name="code" id="code" class="form-control" required autofocus>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Verify</button>
    </form>
</div>
@endsection
