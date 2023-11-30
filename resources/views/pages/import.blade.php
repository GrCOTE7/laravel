@extends ('layouts.main')
@section('title')
Test
@endsection

@section('main')

<div class="container">
    {{-- @php
        use App\Models\User;
        use App\Models\Location;

        $u = User::find(1);
        echo $u->email.'<hr>';

        $locations = Location::all();
        foreach ($locations as $location) {
            echo $location->name.'<br>';
        }
    @endphp --}}

        <h1>Import: {!! $data !!}</h1>
    </div>
@endsection
