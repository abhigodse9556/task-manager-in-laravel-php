@extends('layouts.app')

@section('page-css')
@vite(['resources/css/tasks.css'])
@endsection

@section('content')

<div class="container task-container">

    <div class="header">

        @if (isset($user))
        <div class="flex gap-4">
            <h1>
                Tasks for
            </h1>
            <h1 class="gradient-text">{{ $user['name'] }}</h1>
        </div>
        @else
        <h1>Tasks</h1>
        @endif

        <a href="{{ route('tasks.create') }}" class="button">
            + Create Task
        </a>

    </div>

    @foreach ($tasks as $task)

    <div class="task-card">

        <div>
            <strong>
                {{ $task->title }}
            </strong>

            <div>
                Task #{{ $task->id }}
            </div>
        </div>

        <div class="status">

            {{ $task->status }}

            <a class="button btn-warning" href="{{ route('tasks.edit', $task->id) }}">
                Edit
            </a>

            <form
                method="POST"
                action="{{ route('tasks.destroy', $task->id) }}"
                style="display: inline;">

                @csrf
                @method('DELETE')

                <x-button class="button btn-danger" type="submit">
                    Delete
                </x-button>

            </form>

        </div>

    </div>

    @endforeach

</div>

@endsection