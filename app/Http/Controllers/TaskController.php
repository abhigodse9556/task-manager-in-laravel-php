<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = $request->user()
            ->tasks()
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $request->user()->tasks()->create($validated);

        return redirect('/tasks');
    }

    public function edit(Request $request, Task $task)
    {
        $task = $request->user()
            ->tasks()
            ->findOrFail($task->id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $task = $request->user()
            ->tasks()
            ->findOrFail($task->id);

        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $task->update($validated);

        return redirect('/tasks');
    }

    public function destroy(Request $request, Task $task)
    {
        $task = $request->user()
            ->tasks()
            ->findOrFail($task->id);

        $task->delete();

        return redirect('/tasks');
    }
}
