@extends ('layouts.main')

@section('title')
    Contact
@endsection

@section('main')
    Create Contact
    <hr>
    <br>
    <div class="container d-flex justify-content-center">
        <div class="row card text-white bg-dark">
            <h4 class="card-header">Contactez-moi</h4>
            <div class="card-body">
                <form action="{{ route('contact.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control  @error('nom') is-invalid @enderror" name="nom"
                            id="nom" placeholder="Votre nom" value="{{ old('nom', 'Lionel') }}">
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @php
                        $m = env('MAIL_FROM_ADDRESS');
                    @endphp
                    <div class="mb-3">
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                            id="email" placeholder="Votre email" value="{{ old('email', "$m") }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control  @error('message') is-invalid @enderror" name="message" id="message"
                            placeholder="Votre message">{{ old('message', 'Abc') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-secondary">Envoyer !</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        textarea {
            resize: none;
        }

        .card {
            width: 25em;
        }
    </style>
@endsection
