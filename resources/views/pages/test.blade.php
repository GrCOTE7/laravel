@extends ('layouts.main')
@section('title')
    Test
@endsection

@section('main')
    <h1>Test</h1>
    <p>{!! $data ?? '$data is empty' !!}</p>

    <hr>
    
    php:
    @php
        echo phpversion();
    @endphp

    {{-- <form action="" method="POST">
        @csrf
        <button>Set Session Var</button>
    </form> --}}
@endsection
