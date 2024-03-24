@extends ('layouts.main')
@section('title')
    User Infos
@endsection

@section('css')
    @if (isset($css))
        <style>
            {{ $css }}
        </style>
    @endif
@endsection

@section('main')
    <div class="container d-flex justify-content-center">
        <div class="row card text-white bg-dark">
            <h2 class="card-header mt-2">@yield('title')</h2>
            <div class="card-body">
                <form action="{{ url('users') }}" method="POST">
                    @csrf
                    <label for="nom">
                        {{ __('Enter the name you\'re looking for:') }}
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom"
                            name="nom" value="{{ old('nom', 'GC7z') }}">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <br>
                        <input type="submit" value="{{ __('Send') }} !" class="mb-3">
                </form>
                <hr>
                <table>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
