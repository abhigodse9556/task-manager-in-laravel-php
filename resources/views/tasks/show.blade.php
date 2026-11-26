@extends('layouts.app')

@section('content')

<div class="container task-details-container">

    <div class="task-details-card">

        {{-- Header --}}
        <div class="task-details-header">

            <div>
                <div class="flex gap-4 items-center">
                    <a href="{{ route('tasks.index') }}" class="back">
                        ←
                    </a>
                    <p class="task-details-label">
                        Task #{{ $task->id }}
                    </p>
                </div>
                <h1>
                    {{ $task->title }}
                </h1>
            </div>

            <div class="task-details-actions">

                <a
                    href="{{ route('tasks.edit', $task) }}"
                    class="button btn-warning">
                    <x-heroicon-o-pencil-square class="h-6 w-6" />
                </a>

                <form
                    method="POST"
                    action="{{ route('tasks.restore', $task->id) }}"
                    style="display: inline;">

                    @csrf
                    @method('PATCH')

                    <x-button class="button btn-success" type="submit">
                        <x-tabler-restore class="h-6 w-6" />
                    </x-button>

                </form>

                <form
                    method="POST"
                    action="{{ $task->deleted_at ? route('tasks.forceDelete', $task->id) : route('tasks.destroy', $task) }}">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="button btn-danger"
                        onclick="return confirm('Are you sure you want to delete this task?')">
                        <x-heroicon-o-trash class='h-6 w-6' />
                    </button>
                </form>

            </div>

        </div>


        {{-- Status / Priority --}}
        <div class="task-details-meta">

            <div class="task-detail-item">

                <span class="task-detail-label">
                    Status
                </span>

                <x-tasks.badge :value="$task->status" :type="'status'" />

            </div>


            <div class="task-detail-item">

                <span class="task-detail-label">
                    Priority
                </span>

                <x-tasks.badge :value="$task->priority" :type="'priority'" />

            </div>

        </div>


        {{-- Description --}}
        <div class="task-detail-section">

            <h2>
                Description
            </h2>

            @if ($task->description)

            <p class="task-description">
                {{ $task->description }}
            </p>

            @else

            <p class="task-empty-value">
                No description provided.
            </p>

            @endif

        </div>


        {{-- Date Information --}}
        <div class="task-detail-section">

            <h2>
                Dates
            </h2>

            <div class="task-details-grid">

                <div class="task-detail-item">

                    <span class="task-detail-label">
                        Due Date & Time
                    </span>

                    <x-tasks.badge :value="$task->due_date_time" :type="'date_time'" />

                </div>


                <div class="task-detail-item">

                    <span class="task-detail-label">
                        Completed At
                    </span>

                    <span class="task-detail-value">

                        @if ($task->completed_at)
                        <x-tasks.badge :value="$task->completed_at" :type="'date_time'" />
                        @else
                        <x-tasks.badge :value="$task->status" :type="'status'" />
                        @endif

                    </span>

                </div>


                <div class="task-detail-item">

                    <span class="task-detail-label">
                        Created At
                    </span>

                    <x-tasks.badge :value="$task->created_at" :type="'date_time'" />

                </div>


                <div class="task-detail-item">

                    <span class="task-detail-label">
                        Last Updated
                    </span>

                    <x-tasks.badge :value="$task->updated_at" :type="'date_time'" />

                </div>

                @if($task->deleted_at)
                <div class="task-detail-item">

                    <span class="task-detail-label">
                        Deleted At
                    </span>

                    <x-tasks.badge :value="$task->deleted_at" :type="'date_time'" />

                </div>
                @endif

            </div>

        </div>


        {{-- Database Information --}}
        <div class="task-detail-section">

            <h2>
                Task Information
            </h2>

            <div class="task-details-grid">

                <div class="task-detail-item">

                    <span class="task-detail-label">
                        Task ID
                    </span>

                    <span class="task-detail-value">
                        {{ $task->id }}
                    </span>

                </div>


                <div class="task-detail-item">

                    <span class="task-detail-label">
                        User ID
                    </span>

                    <span class="task-detail-value">
                        {{ $task->user_id }}
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection