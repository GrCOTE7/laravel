<div>
    {{-- The whole world belongs to you. --}}
    <div>
        <input type="text" wire:model.live="monTest" />
        <p>{{ $monTest }}</p>
    </div>

    {{ $monTest }}
    <hr>

    <input type="text" wire:model.live="index" />
    <p>{{ $this->user?->name }}: {{ $this->user?->note }}</p>
    <hr>

    <div>
        <input wire:model.defer="note" type="text" />
        <button wire:click="noter"> Noter </button>
    </div>

    <hr> Noter un autre utilisateur que celui ci-dessus désigné:
    <div>
        <label>Index de l'autre utilisateur</label>
        <input wire:model.defer="indexAutre" type="text" />
        <p style="color: red">{{ $errors->first('indexAutre') }}</p>
        <label>Noter cet autre utilisateur</label>
        <input wire:model.defer="noteAutre" type="text" /><br><br>
        <p style="color: red">{{ $errors->first('noteAutre') }}</p>
        <button wire:click="noterAutre({{ $indexAutre }})">
            Noter cet autre utilisateur
        </button>
        <br>
        Nouvel utilsateur noté: {{ $indexAutre }} - Sa note: {{ $noteAutre }}

    </div>

    <br>(Components livewire)
</div>
