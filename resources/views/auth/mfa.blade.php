@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2>Multi-Factor Authentication</h2>

      @if ($errors->any())
        <div class="alert alert-danger">
          {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('mfa.verify') }}">
        @csrf
        <div class="form-group">
          <label for="code">Enter the 6-digit code sent to your email:</label>
          <input type="text" name="code" class="form-control" required maxlength="6">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Verify</button>
      </form>
    </div>
  </div>
</div>
@endsection
