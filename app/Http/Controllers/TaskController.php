<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        $user = ['id' => 101, 'name' => 'Abhishek'];

        return view('tasks.index', ['tasks' => $tasks, 'user' => $user]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'status' => 'required|in:Pending,In Progress, Completed',
        ]);

        Task::create($validated);

        return redirect('/tasks');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'status' => 'required|in:Pending,In Progress, Completed',
        ]);

        $task->update($validated);

        return redirect('/tasks');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/tasks');
    }
}
