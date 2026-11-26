@extends('layouts.app')

@section('page-css')
@vite(['resources/css/tasks.css'])
@endsection

@section('content')

<div class="container task-container">

    <div class="header">

        @if (auth()->check())
        <div class="flex flex-col gap-0 md:flex-row md:gap-4">
            <h1>
                Tasks for
            </h1>
            <h1 class="gradient-text">{{ auth()->user()->name }}</h1>
        </div>
        @else
        <h1>Tasks</h1>
        @endif

        <a href="{{ route('tasks.create') }}" class="button">
            + Create
        </a>

    </div>

    <div id="tasks-filter-block" class="tasks-filter-block">
        <x-tasks.filter-bar />
    </div>
    <span id="apply-filter-btn" class="visible text-sm text-right underline md:hidden">Apply filters</span>

    <div class="task-list">

        @if ($tasks->isEmpty())
        <div class="no-tasks-container">
            <p>No tasks available.</p>
            <a href="{{ route('tasks.create') }}" class="button">
                + Create Task
            </a>
        </div>
        @endif
        @foreach ($tasks as $task)

        <x-tasks.task-card
            :task="$task" />

        @endforeach

    </div>

</div>

@endsection