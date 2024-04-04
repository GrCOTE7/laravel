@extends ('layouts.main')

@section('title')
    W
@endsection

@section('css')
    <style>
        a {
            color: blue;
        }
    </style>
@endsection

@section('main')
    <h5>Tuto PHP:</h5>
    <a href='/tuto/notifs'>Notifications</a> : Show all notifications style (Bootstrap)<br>
    <a href='/tuto/component'>Component</a> : A component with a variable<br>
    <a href='/tuto/poo'>POO</a> : Base POO PHP<br>
    <hr>
    <h5>Tuto Sillo:</h5>
    <a href='/tuto/article/7'>Page Article</a> : Page d'articles<br>
    <a href='/tuto/contact'>Contact</a> : Contact<br>
    <a href='/tuto/mail'>Mail</a> : Envoi email<br>
    <a href='/tuto/photo'>Photo</a> : Download Photos<br>
    <x-line-separator />
    <h5>Tuto Limewire:</h5>
    <a href='/tuto/limewire'>Limewire</a> : Use of limewire<br>
    <a href='/tuto/user/1'>Imbrication de composants Limewire</a><br>
    <x-line-separator />
    <h5>Tuto Apps:</h5>
    <a href='/tuto/todo'>1<sup><b>ère</b></sup> app</a>: Todolist (Seulement pour les membres connectés)<br>
    <a href='/tuto/album'>Album app</a>: App album (With Volt[Livewire compacted] & MaryUI [Tailwind])<br>
    <hr>
    <h5>Divers:</h5>
    <a href='/tuto/welcome'>Page welcome</a> : Page d'origine Welcome de Laravel<br>
    <a href='/tuto/greg'>Greg</a> : Décodage/codage message crypté<br>
@endsection

@section('prescripts')
    <script src="{{ asset('assets/js/scrollDown.js') }}"></script>
@endsection
