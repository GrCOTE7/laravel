<div>
    {{-- The whole world belongs to you. --}}
    <div>
        <input type="text" wire:model.live="monTest" />
        <p>{{ $monTest }}</p>
    </div>

    {{ $monTest }}
    <hr>

    <input type="text" wire:model.live="index" />
    <p>{{ $this->user?->name }}</p>

    <br>(Components livewire)
</div>
