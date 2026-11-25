@props([
'task',
'showActions' => true,
'bin' => false,
])

<div class="task-card">

    <div>
        <strong>
            {{ $task->title }}
        </strong>

        <div class="flex gap-2">
            <x-tasks.badge :value="$task->priority" :type="'priority'" />

            <x-tasks.badge :value="$task->due_date_time" :type="'due_date_time'" />
        </div>
    </div>

    <div class="status">

        <x-tasks.badge :value="$task->status" :type="'status'" />

        @if ($showActions && !$bin)

        <a
            class="button btn-warning"
            href="{{ route('tasks.edit', $task->id) }}">
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

        @endif

        @if ($bin)

        <form
            method="POST"
            action="{{ route('tasks.restore', $task->id) }}"
            style="display: inline;">

            @csrf
            @method('PATCH')

            <x-button class="button btn-success" type="submit">
                Restore
            </x-button>

        </form>

        <form
            method="POST"
            action="{{ route('tasks.forceDelete', $task->id) }}"
            style="display: inline;">

            @csrf
            @method('DELETE')

            <x-button class="button btn-danger" type="submit">
                Delete Permanently
            </x-button>

        </form>

        @endif

    </div>

</div>