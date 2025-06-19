@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>
    <a href="{{ route('admin.users') }}">View Users</a>
@endsection
