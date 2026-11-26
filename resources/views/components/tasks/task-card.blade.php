@props([
'task',
'showActions' => true,
'bin' => false,
])

<div class="task-card">

    <div>
        <a
            href="{{ $bin ? route('tasks.bin.show', $task) : route('tasks.show', $task) }}">
            <strong>
                {{ $task->title }}
            </strong>
        </a>


        <div class="flex gap-2">
            <x-tasks.badge :value="$task->priority" :type="'priority'" />

            <x-tasks.badge :value="$task->due_date_time" :type="'date_time'" />
        </div>
    </div>

    <div class="status flex items-center"">

        <x-tasks.badge :value=" $task->status" :type="'status'" />

        @if ($showActions && !$bin)

        <div class="card-actions">

            <a
                class="button btn-warning"
                href="{{ route('tasks.edit', $task->id) }}">
                <x-heroicon-o-pencil-square class="h-6 w-6" />
            </a>

            <form
                method="POST"
                action="{{ route('tasks.destroy', $task->id) }}">

                @csrf
                @method('DELETE')

                <x-button class="button btn-danger" type="submit">
                    <x-heroicon-o-trash class='h-6 w-6' />
                </x-button>

            </form>

        </div>

        @endif

        @if ($bin)

        <div class="card-actions">

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
                action="{{ route('tasks.forceDelete', $task->id) }}"
                style="display: inline;">

                @csrf
                @method('DELETE')

                <x-button class="button btn-danger" type="submit">
                    <x-heroicon-o-trash class='h-6 w-6' />
                </x-button>

            </form>

        </div>
        @endif
    </div>

</div>