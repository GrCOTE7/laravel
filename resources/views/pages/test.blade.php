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

    <p>{!! $data ?? '$data is empty' !!}</p>
    <hr>
    @lang('Hi, dear friend') !<br>
    @php
        $n = 0;
    @endphp
    {{ $n }} {{ trans_choice(__('point|points'), $n) }}.
@endsection
