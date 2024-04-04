<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Show a task')
        </h2>
    </x-slot>

    <x-tasks-card>
        <h3 class="font-semibold text-xl text-gray-800">@lang('Title')</h3>
        <p>{{ $task->title }}</p>
        <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Detail')</h3>
        <p>{{ $task->detail }}</p>
        <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('State')</h3>
        <p>
            @if ($task->state)
                La tâche a été accomplie !
            @else
                La tâche n'a pas encore été accomplie.
            @endif
        </p>
        <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Date creation')</h3>
        <p>{{ $task->created_at->format('d/m/Y - H:i') }}</p>
        @if ($task->created_at != $task->updated_at)
            <h3 class="font-semibold text-xl text-gray-800 pt-2">@lang('Last update')</h3>
            <p>{{ $task->updated_at->format('d/m/Y -H:i') }}</p>
        @endif
    </x-tasks-card>
</x-app-layout>
