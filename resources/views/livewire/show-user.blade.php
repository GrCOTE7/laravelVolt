<div>
    <p>Nom = {{ $user->name }}</p>
    <p>Email = {{ $user->email }}</p>
    @livewire('note-user', ['user' => $user])
</div>
