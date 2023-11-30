@extends ('layouts.main')
@section('title')
    Test
@endsection

@section('main')
    <h1>Test</h1>
    <p>{!! $myVar ?? 'Empty' !!}</p>
    {{-- <form action="" method="POST">
        @csrf
        <button>Set Session Var</button>
    </form> --}}
@endsection
