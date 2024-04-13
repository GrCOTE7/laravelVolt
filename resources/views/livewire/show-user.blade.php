<div>

    <p>Nom = {{ $user->name }}</p>
    <p>Email = {{ $user->email }}</p>
    <p>Note = {{ $user->note }}</p>

    @livewire('note-user', ['user' => $user])
</div>
