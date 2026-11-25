@extends('layouts.app')

@section('content')

<div class="bin-container">

    <div class="header">
        <h1>Bin</h1>
    </div>

    @forelse ($tasks as $task)


    <x-tasks.task-card
        :task="$task"
        :bin="true" />

    @empty

    <p>Your bin is empty.</p>

    @endforelse

</div>

@endsection