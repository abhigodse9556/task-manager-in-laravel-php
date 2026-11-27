<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->tasks();

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

        return response()->json(
            $query->get()
        );
    }

    public function show(Request $request, int $id)
    {
        $task = $request->user()
            ->tasks()
            ->findOrFail($id);

        return response()->json($task);
    }

    public function store(Request $request)
    {
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

        $task = $request->user()
            ->tasks()
            ->create($validated);

        return response()->json($task, 201);
    }

    public function update(Request $request, int $id)
    {
        $task = $request->user()
            ->tasks()
            ->findOrFail($id);

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

        return response()->json($task);
    }

    public function destroy(Request $request, int $id)
    {
        $task = $request->user()
            ->tasks()
            ->findOrFail($id);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully.',
        ]);
    }

    public function bin(Request $request)
    {
        $tasks = $request->user()
            ->tasks()
            ->onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return response()->json($tasks);
    }

    public function restore(Request $request, int $id)
    {
        $task = $request->user()
            ->tasks()
            ->onlyTrashed()
            ->findOrFail($id);

        $task->restore();

        return response()->json($task);
    }

    public function forceDelete(Request $request, int $id)
    {
        $task = $request->user()
            ->tasks()
            ->onlyTrashed()
            ->findOrFail($id);

        $task->forceDelete();

        return response()->json([
            'message' => 'Task permanently deleted.',
        ]);
    }
}
