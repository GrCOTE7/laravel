<div>
    <h1>Show User #{{ $user->id }} :</h1>
    <p>Nom = {{ $user->name }}</p>
    <p>Email = {{ $user->email }}</p>
    <p>Note = {{ $user->note }}</p>
    <hr>
    @livewire('note-user', ['user'=>$user])
</div>
