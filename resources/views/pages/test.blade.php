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
    <h1>Test ({{ App::currentLocale() }})</h1>
    <!-- resources/views/welcome.blade.php -->

    <p>$data: {!! $data ?? '$data is empty' !!}</p>

@endsection
