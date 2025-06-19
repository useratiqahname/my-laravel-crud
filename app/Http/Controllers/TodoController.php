<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TodoController extends Controller
{
    public function __construct()
    {
        // Require user to be authenticated for all methods
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();

    // Set permissions based on role
    $user = auth()->user();

    if ($user->role === 'admin') {
        $permissions = ['Create', 'Retrieve', 'Update', 'Delete']; // full access
    } elseif ($user->role === 'user') {
        // Load specific permissions for 'user'
        $permissions = ['Retrieve', 'Create']; // example
    } else {
        $permissions = []; // no permissions
    }

    return view('todo.list', compact('todos', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,completed'],
        ]);

        $userId = Auth::id();

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->status = $request->status;
        $todo->user_id = $userId;
        $saved = $todo->save();

        if ($saved) {
            return redirect()->route('todo.index')->with('success', 'Todo successfully added.');
        }

        return redirect()->route('todo.index')->with('error', 'Failed to add Todo.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $userId = Auth::id();

        $todo = Todo::where('id', $id)->where('user_id', $userId)->first();

        if (!$todo) {
            return redirect()->route('todo.index')->with('error', 'Todo not found.');
        }

        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,completed'],
        ]);

        $userId = Auth::id();

        $todo = Todo::where('id', $id)->where('user_id', $userId)->first();

        if (!$todo) {
            return redirect()->route('todo.index')->with('error', 'Todo not found.');
        }

        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->status = $request->status;

        if ($todo->save()) {
            return redirect()->route('todo.index')->with('success', 'Todo successfully updated.');
        }

        return redirect()->route('todo.index')->with('error', 'Failed to update Todo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $userId = Auth::id();

        $todo = Todo::where('id', $id)->where('user_id', $userId)->first();

        if (!$todo) {
            return redirect()->route('todo.index')->with('error', 'Todo not found.');
        }

        if ($todo->delete()) {
            return redirect()->route('todo.index')->with('success', 'Todo deleted successfully.');
        }

        return redirect()->route('todo.index')->with('error', 'Failed to delete Todo.');
    }
}
