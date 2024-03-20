@extends ('layouts.main')
@section('title')
    User Infos
@endsection

@section('css')
    @if (isset($css))
        <style>
            {{ $css }}
        </style>
    @endif
@endsection

@section('main')
    <h1>@yield('title')</h1>
    <form action="{{ url('users') }}" method="POST">
        {{-- @csrf --}}
        <label for="nom">Entrez votre nom : </label>
        <input type="text" name="nom" id="nom">
        <input type="submit" value="Envoyer !">
    </form>
@endsection
