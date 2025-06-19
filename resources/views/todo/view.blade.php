@extends('layouts.app')
@section('content')
<div class="container">
  <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Todo Details</h2>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <a href="{{ route('todo.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <br>
        <div class="col-md-12">
            <br><br>
            <div class="todo-title">
                <strong>Title: </strong> {{ $todo->title }}
            </div>
            <br>
            <div class="todo-description">
                <strong>Description: </strong> {{ $todo->description }}
            </div>
            <br>
            <div class="todo-description">
                <strong>Status: </strong> {{ $todo->status }}
            </div>
            <br>

            {{-- RBAC: Show Edit/Delete if user has permission --}}
            <div class="d-flex">
                @if(in_array('Update', $permissions))
                    <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-warning mr-2">Edit</a>
                @endif

                @if(in_array('Delete', $permissions))
                    <form action="{{ route('todo.destroy', $todo->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
