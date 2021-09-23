<div>
    <div>
        @foreach ($contacts as $contact)
                    @livewire('say-hi', ['contact' => $contact], key($contact->name))
        @endforeach
    </div>

    <input wire:model="name" type="text">

    <form action="#" wire:submit.prevent="resetName('Controller resetName Haribo')">
        <button class="border-gray-900 bg-green-300 px-6 py-1">Reset Name</button>
    </form>
</div>
