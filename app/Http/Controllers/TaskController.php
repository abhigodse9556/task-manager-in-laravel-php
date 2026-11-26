<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()
            ->tasks();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Priority filter
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Sort
        $sort = $request->input('sort', 'newest');

        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;

            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;

            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;

            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $tasks = $query->get();

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

        if ($validated['status'] === 'Completed') {
            $validated['completed_at'] = now();
        } else {
            $validated['completed_at'] = null;
        }

        $request->user()->tasks()->create($validated);

        return redirect('/tasks');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.show', [
            'task' => $task,
        ]);
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

        if ($validated['status'] === 'Completed') {
            $validated['completed_at'] = $task->completed_at ?? now();
        } else {
            $validated['completed_at'] = null;
        }

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
