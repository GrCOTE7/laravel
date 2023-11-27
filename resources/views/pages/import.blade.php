@extends ('layouts.main')
@section('title')
Test
@endsection

@section('main')
<br>
<div class="container">
    @php
        use App\Models\User;
        $u = User::find(1);
        echo $u->email;
    @endphp

        <h1>Import: {{ $rep }}</h1>
    </div>
@endsection
