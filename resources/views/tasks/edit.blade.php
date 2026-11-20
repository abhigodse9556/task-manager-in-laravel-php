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

            <button class="button" type="submit">
                Update Task
            </button>

        </form>

    </div>

</div>

@endsection