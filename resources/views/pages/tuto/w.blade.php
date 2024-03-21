@extends ('layouts.main')

@section('title')
    W
@endsection

@section('main')
    Tuto Sillo
    <hr>
    <a href='/w/welcome'>Page welcome</a> : Page d'origine Welcome de Laravel<br>
    <a href='/w/article/7'>Page Article</a> : Page d'articles<br>
    <a href='/w/contact'>Contact</a> : Contact<br>
    <a href='/w/mail'>Mail</a> : Envoi email<br>
    <a href='/w/greg'>Greg</a> : Décodage/codage message crypté<br>

@endsection

@section('prescripts')
    <script src="{{ asset('assets/js/scrollDown.js') }}"></script>
@endsection
