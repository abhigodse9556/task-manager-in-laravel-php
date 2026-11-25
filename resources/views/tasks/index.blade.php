@extends('layouts.app')

@section('page-css')
@vite(['resources/css/tasks.css'])
@endsection

@section('content')

<div class="container task-container">

    <div class="header">

        @if (auth()->check())
        <div class="flex gap-4">
            <h1>
                Tasks for
            </h1>
            <h1 class="gradient-text">{{ auth()->user()->name }}</h1>
        </div>
        @else
        <h1>Tasks</h1>
        @endif

        <a href="{{ route('tasks.create') }}" class="button">
            + Create Task
        </a>

    </div>

    @foreach ($tasks as $task)

    <x-tasks.task-card
        :task="$task" />

    @endforeach

</div>

@endsection