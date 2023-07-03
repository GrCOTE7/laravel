@extends ('layouts.main')
@section('title')
    Test
@endsection

@section('main')
    <h1>Test</h1>

    {{ $maVar ?? 'maVar is empty' }}
@endsection
