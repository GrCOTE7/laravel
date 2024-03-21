@extends ('layouts.main')
@section('title')
    Mail
@endsection

@section('main')
    AppName: <b>{{ $appName }}</b>
    <hr>

    MAIL
    <form method="POST">
        @csrf
        <button>Send eMail</button><br>
        {{ $msg ?? '' }}

        <hr>
        Vue du email avant l'envoi:
        <hr>
        {!! $vueEmail ?? 'not yet' !!}
        </hr>
    </form>
@endsection
