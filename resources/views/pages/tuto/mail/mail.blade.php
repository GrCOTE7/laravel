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

        <a href = '/mail/view'>View only email (Without CSS of Page)</a>

        <hr>
        Vue du email avant l'envoi:
        <hr>
        {!! $vueEmail ?? 'not yet' !!}
        </hr>
    </form>
@endsection
