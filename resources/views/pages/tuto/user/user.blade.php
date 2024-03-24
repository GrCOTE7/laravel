@extends ('layouts.main')
@section('title')
    Users
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
    Choix: {{ $userChoice }}
    <hr>
    <ul>
        @foreach ($users as $u)
            <li>
                <p>{!! $u->name ?? '$data is empty' !!}</p>
            </li>
        @endforeach
    </ul>
    <hr>
    {{ $code ?? 'Nothing' }} (Passé / session)

    {{-- <form action="" method="POST">
        @csrf
        <button>Set Session Var</button>
    </form> --}}
@endsection
