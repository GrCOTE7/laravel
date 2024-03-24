@php
    use App\View\Components\Lang;
    use Illuminate\Support\Facades\App;
    $langs = ['en', 'fr'];
    $lang = app()->getLocale();
    var_dump($lang);
    // $otherLang = $langs % 2;
@endphp
@extends ('layouts.main')
@section('title')
    {{ __('UInf') }}
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
            {{-- {{ App::get('locale') }} --}}
            <x-lang />
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
