@extends('layouts.app')

@section('content')
    <h1>Registered Users</h1>
    <table>
        <tr>
            <th>Name</th><th>Email</th><th>Status</th><th>Toggle</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
            <td>
                <form method="POST" action="{{ route('admin.users.toggle', $user->id) }}">
                    @csrf
                    <button type="submit">Toggle</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
