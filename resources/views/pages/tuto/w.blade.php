@extends ('layouts.main')

@section('title')
    W
@endsection

@section('main')
    Tuto Sillo
    <hr>
    <a href='w/welcome'>Page welcome</a> : Page d'origine Welcome de Laravel<br>
    <a href='w/article/7'>Page Article</a> : Page d'articles

@endsection

@section('prescripts')
    <script src="{{ asset('assets/js/scrollDown.js') }}"></script>
@endsection
