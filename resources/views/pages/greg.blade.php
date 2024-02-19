@extends ('layouts.main')

@section('title')
    Greg
@endsection

@section('main')
    Message
    <hr>
    {!! $response ?? '$response is empty' !!}

    <hr>
    {!! $decoded ?? '$decoded is empty' !!}
    <hr>
    {!! $msg ?? '$msg is empty' !!}
@endsection
