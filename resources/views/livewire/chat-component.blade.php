<div>

    @foreach ($convos as $convo)
        {{ $convo['username'] }} : {{ $convo['message'] }} <br>
    @endforeach

    <form wire:submit="submit">
        <input type="text" wire:model="message">
        <button type="submit">send</button>
    </form>
</div>
