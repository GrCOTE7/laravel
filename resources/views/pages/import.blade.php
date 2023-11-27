@extends ('layouts.main')
@section('title')
Test
@endsection

@section('main')
<br>
<div class="container">
    @php
        use App\Models\User;
        use App\Models\Location;

        $u = User::find(1);
        echo $u->email.'<hr>';

        $locations = Location::all();
        foreach ($locations as $location) {
            echo $location->name.'<br>';
        }
    @endphp

        <h1>Import: {{ $rep }}</h1>
    </div>
@endsection
