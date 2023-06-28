@extends ('layouts.main')
@section('title')
    Test
@endsection

@section('main')
    <h1>Test Page</h1>

    <div class="box">
        I'm in <mark>a box</mark>.
    </div>

    <form class="box">
        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="email" placeholder="e.g. alex@example.com">
            </div>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input cl ass="input" type="password" placeholder="********" autocomplete=true>
            </div>
        </div>

        <button class="button is-primary">Sign in</button>
    </form>

    {{-- Data: {{ $data ?? 'No' }} --}}

    Data: Date in french : {{ $dataSend }}

    {{-- @foreach ($data as $user)
        {{ $user->name }}<br>
    @endforeach --}}

@endsection
