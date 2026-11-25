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

        <h1>Create Task</h1>

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

        <form method="POST" action="/tasks">

            @csrf

            <label for="title">
                Task Title
            </label>

            <input
                type="text"
                id="title"
                name="title"
                placeholder="Enter task title"
                value="{{ old('title') }}">

            <label for="description">
                Task Description
            </label>

            <textarea
                id="description"
                name="description"
                placeholder="Enter task description">{{ old('description') }}</textarea>

            <label for="status">
                Status
            </label>

            <select id="status" name="status">

                <option class="bg-gray-500 text-white" value="In Progress" disabled>
                    Select status
                </option>

                <option class="bg-black text-white hover:text-gray-500 hover:bg-black" value="Pending">
                    Pending
                </option>

                <option class="bg-black text-white" value="In Progress">
                    In Progress
                </option>

                <option class="bg-black text-white" value="Completed">
                    Completed
                </option>

            </select>

            <label for="due_date_time">
                Due Date & Time
            </label>

            <input
                type="datetime-local"
                id="due_date_time"
                name="due_date_time"
                value="{{ old('due_date_time') }}">

            <label for="priority">
                Priority
            </label>

            <select id="priority" name="priority">

                <option class="bg-gray-500 text-white" value="Low" disabled>
                    Select priority
                </option>

                <option class="bg-black text-white hover:text-gray-500 hover:bg-black" value="Low">
                    Low
                </option>

                <option class="bg-black text-white" value="Medium">
                    Medium
                </option>

                <option class="bg-black text-white" value="High">
                    High
                </option>

            </select>

            <button class="button" type="submit">
                Create Task
            </button>

        </form>

    </div>

</div>

@endsection