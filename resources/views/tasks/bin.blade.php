@extends('layouts.app')

@section('content')

<div class="container task-container">

    <div class="header">
        <h1>Bin</h1>
    </div>
    <div class="task-list">
        @forelse ($tasks as $task)


        <x-tasks.task-card
            :task="$task"
            :bin="true" />

        @empty
        <div class="no-tasks-container">
            <p>Your bin is empty</p>
        </div>

        @endforelse
    </div>

</div>

@endsection