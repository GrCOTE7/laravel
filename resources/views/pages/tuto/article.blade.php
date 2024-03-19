@extends ('layouts.main')

@section('title')
    Article
@endsection

@section('main')
    Page Article {{ $numero }}
    <hr>
    @php
        $numero = $numero == 7 ? 8 : 7;
    @endphp
    <a href="{{ $numero }}">Voir article {{ $numero }}</a>
@endsection

@section('prescripts')
    <script src="{{ asset('assets/js/scrollDown.js') }}"></script>
@endsection
