@extends ('layouts.main')

@section('title')
    Greg
@endsection

@section('main')
    Message
    <hr>
    {{-- {!! $msg ?? '$msg is empty' !!}
    <hr>
    {!! $decoded ?? '$decoded is empty' !!}
    <hr> --}}
    {!! $response ?? '$response is empty' !!}
@endsection

@section('prescripts')
    <script src="{{ asset('assets/js/scrollDown.js') }}"></script>
@endsection
