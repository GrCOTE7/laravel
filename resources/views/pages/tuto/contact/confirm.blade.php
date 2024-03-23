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
            <h4 class="card-header">Contact</h4>
            <div class="card-body">
                <p class="card-text">Merci. Votre message a été transmis à l'administrateur du site. Vous recevrez une
                    réponse rapidement.</p>
            </div>
            <p class="card-text mb-3">{{ $data }}</p>
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
