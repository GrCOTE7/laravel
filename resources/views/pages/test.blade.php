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

    @lang('Hi, dear friend') !<br>
    @php
        $n = 10;
    @endphp

    <hr>
    In the view component: <x-component :var=123 />
    <hr>

    {{ $n }} {{ trans_choice(__('point|points'), $n) }}.
@endsection
