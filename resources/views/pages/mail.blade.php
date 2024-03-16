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
    </form>
@endsection
