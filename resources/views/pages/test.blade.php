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
    <p>{!! $data ?? '$data is empty' !!}</p>
@endsection
