@extends ('layouts.main')
@section('title')
    Mail
@endsection

@section('main')
    MAIL
    <form method="POST">
        @csrf
        <button>Send eMail</button><br>
        {{ $msg ?? '' }}
    </form>
@endsection
