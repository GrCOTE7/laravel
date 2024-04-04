<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a task') }}
        </h2>
    </x-slot>

    <x-tasks-card>

        <!-- Message de réussite -->
        @if (session()->has('message'))
            <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('todo.store') }}" method="post">
            @csrf

            <!-- Titre -->
            <div>
                <x-label for="title" :value="__('Title')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required
                    autofocus />

                <x-input-error for="title" message="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Détail -->
            <div class="mt-4">
                <x-label for="detail" :value="__('Detail')" />

                <x-textarea class="block mt-1 w-full" id="detail" name="detail">{{ old('detail') }}</x-textarea>

                <x-input-error for="detail" message="$errors->get('detail')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Send') }}
                </x-button>
            </div>
        </form>

    </x-tasks-card>
</x-app-layout>
