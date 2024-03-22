@extends ('layouts.main')

@section('title')
    W
@endsection

@section('main')
    <h5>Tuto PHP</h5>
    <a href='/tuto/poo'>POO</a> : Base POO PHP<br>
    <hr>
    <h5>Tuto Sillo</h5>
    <a href='/tuto/article/7'>Page Article</a> : Page d'articles<br>
    <a href='/tuto/contact'>Contact</a> : Contact<br>
    <a href='/tuto/mail'>Mail</a> : Envoi email<br>
    <a href='/tuto/photo'>Photo</a> : Download Photos<br>
    <hr>
    <h5>Divers</h5>
    <a href='/tuto/welcome'>Page welcome</a> : Page d'origine Welcome de Laravel<br>
    <a href='/tuto/greg'>Greg</a> : Décodage/codage message crypté<br>
@endsection

@section('prescripts')
    <script src="{{ asset('assets/js/scrollDown.js') }}"></script>
@endsection
