@extends('layouts.app')

@section('page-css')
@vite(['resources/css/tasks.css'])
@endsection

@section('content')

<div class="container task-manipulation-container">

    <a href="/tasks" class="back">
        ← Back to Tasks
    </a>

    <div class="form-card">

        <h1>Edit Task</h1>

        @if ($errors->any())
        <div>
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="/tasks/{{ $task->id }}">

            @csrf
            @method('PUT')

            <label for="title">
                Task Title
            </label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ $task->title }}">

            <label for="description">
                Task Description
            </label>

            <textarea
                id="description"
                name="description"
                placeholder="Enter task description">{{ $task->description }}</textarea>

            <label for="status">
                Status
            </label>

            <select id="status" name="status">

                <option value="Pending"
                    {{ $task->status === 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="In Progress"
                    {{ $task->status === 'In Progress' ? 'selected' : '' }}>
                    In Progress
                </option>

                <option value="Completed"
                    {{ $task->status === 'Completed' ? 'selected' : '' }}>
                    Completed
                </option>

            </select>

            <label for="due_date_time">
                Due Date and Time
            </label>

            <input
                type="datetime-local"
                id="due_date_time"
                name="due_date_time"
                value="{{ $task->due_date_time ? $task->due_date_time->format('Y-m-d\TH:i') : '' }}">

            <label for="priority">
                Priority
            </label>

            <select id="priority" name="priority">

                <option value="Low"
                    {{ $task->priority === 'Low' ? 'selected' : '' }}>
                    Low
                </option>

                <option value="Medium"
                    {{ $task->priority === 'Medium' ? 'selected' : '' }}>
                    Medium
                </option>

                <option value="High"
                    {{ $task->priority === 'High' ? 'selected' : '' }}>
                    High
                </option>

            </select>

            <button class="button" type="submit">
                Update Task
            </button>

        </form>

    </div>

</div>

@endsection