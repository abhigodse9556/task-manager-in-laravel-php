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
        $this->authorize('create', Task::class);

        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Task::class);

        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
            'priority' => 'required|in:Low,Medium,High',
            'due_date_time' => 'nullable|date',
        ]);

        $request->user()->tasks()->create($validated);

        return redirect('/tasks');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
            'priority' => 'required|in:Low,Medium,High',
            'due_date_time' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect('/tasks');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect('/tasks');
    }

    public function bin(Request $request)
    {
        $tasks = $request->user()
            ->tasks()
            ->onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return view('tasks.bin', compact('tasks'));
    }

    public function restore(Task $task)
    {
        $this->authorize('restore', $task);

        $task->restore();

        return redirect()->route('tasks.bin');
    }

    public function forceDelete(Task $task)
    {
        $this->authorize('forceDelete', $task);

        $task->forceDelete();

        return redirect()->route('tasks.bin');
    }
}
