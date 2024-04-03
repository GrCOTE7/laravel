<div>
    <form wire:submit.prevent="submit">
        <label>Note</label>
        <input wire:model="note" type="text" autofocus />
        <p style="color: red">{{ $errors->first('note') }}</p>
        <button type="submit">
            Noter
        </button>
    </form>
</div>
