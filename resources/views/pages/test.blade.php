@extends ('layouts.main')
@section('title')
    Test
@endsection

@section('css')
    @if (isset($css))
        <style>
            {{ $css }}
        </style>
    @endif
@endsection

@section('main')
    <h1>Test</h1>
    <!-- resources/views/welcome.blade.php -->
    <x-alert>
        In my Vue (Here the slot in a app/view/component)</i>
    </x-alert>

    <p>{!! $data ?? '$data is empty' !!}</p>
@endsection
