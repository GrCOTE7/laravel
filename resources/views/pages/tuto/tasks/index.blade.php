<x-app-layout>
    <x-slot name="header">
        <p
            class="flex items-center justify-between m-0 font-semibold text-gray-800 h-5 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 align-items:center border-0 border-red-700">
            @lang('Tasks List')
            <a href="{{ route('todo.create') }}">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded text-center mt-0 px-7"
                    title="{{ __('Create a task') }}">
                    +
                </button>
            </a>
        </p>
    </x-slot>

    <!-- Message de réussite -->
    @if (session()->has('message'))
        <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
            {{ session('message') }}
        </div>
    @endif

    <div class="container flex justify-center mx-auto">
        <div class="flex flex-col">
            <div class="w-full">
                <div class="border-b border-gray-200 shadow pt-6">
                    <table>
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-2 py-2 text-xs text-gray-500">#</th>
                                <th class="px-2 py-2 text-xs text-gray-500">@lang('Title')</th>
                                <th class="px-2 py-2 text-xs text-gray-500">Etat</th>
                                <th colspan="3" class="px-2 py-2 text-xs text-gray-500 ">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($tasks as $task)
                                <tr class="whitespace-nowrap">

                                    <td class="px-4 py-4 text-sm text-gray-500">{{ $task->id }}</td>

                                    <td class="px-4 py-4">{{ $task->title }}</td>

                                    <td class="px-4 py-4">
                                        @if ($task->state)
                                            {{ __('Done') }}
                                        @else
                                            {{ __('To do') }}
                                        @endif
                                    </td>

                                    <x-link-button href="{{ route('todo.show', $task->id) }}">
                                        @lang('Show')
                                    </x-link-button>

                                    <x-link-button href="{{ route('todo.edit', $task->id) }}">
                                        @lang('Edit')
                                    </x-link-button>

                                    <x-link-button
                                        onclick="event.preventDefault(); document.getElementById('destroy{{ $task->id }}').submit();">
                                        @lang('Delete')
                                    </x-link-button>

                                    <form id="destroy{{ $task->id }}"
                                        action="{{ route('todo.destroy', $task->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>
