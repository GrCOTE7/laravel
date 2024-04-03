<div>
    {{-- The whole world belongs to you. --}}
    <div>
        <input type="text" wire:model.live="monTest" />
        <p>{{ $monTest }}</p>
    </div>

    {{ $monTest }}

    <hr>

    <p>Donne le nom & la note de l'utilisateur d'id n°:</p>
    <input type="text" wire:model.live="index" />
    @if ($this->user)
        <p>{{ $this->user?->name }}: {{ $this->user?->note }}</p>
    @endif
    <hr>

    <p>Idem, mais avec message d'erreur si id incorrect:</p>
    <input type="text" wire:model.live="userVerifiedId" placeholder="Entrez l'ID d'un utilisateur" />
    @if ($userVerified)
        <p>{{ $userVerified?->name }}: {{ $userVerified?->note }}</p>
    @else
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    @endif

    <hr>

    <div>
        <input wire:model.defer="note" type="text" />
        <button wire:click="noter"> Noter </button>
        <p style="color: red">{{ $errors->first('note') }}</p>
    </div>

    <hr>

    <p>Noter un autre utilisateur que celui ci-dessus désigné:</p>
    <div>
        <label>Index de l'autre utilisateur</label>
        <input wire:model.defer="indexAutre" type="text" />
        <p style="color: red">{{ $errors->first('indexAutre') }}</p>
        <label>Noter cet autre utilisateur</label>
        <input wire:model.defer="noteAutre" type="text" />
        <p style="color: red">{{ $errors->first('noteAutre') }}</p>
        <button wire:click="noterAutre({{ $indexAutre }})">
            Noter cet autre utilisateur
        </button>
        <br>
        Nouvel utilsateur noté: {{ $indexAutre }} - Sa note: {{ $noteAutre }}

    </div>

    <br>(Components livewire)
</div>
