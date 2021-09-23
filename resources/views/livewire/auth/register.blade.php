<div>
    <div class="m-2">
        searchName : <input type="text" wire:model="searchName">
    </div>
    <div class="m-2">
        searchName2 : <input type="text" wire:model.defer="searchName2">
{{--        <button wire:click="$refresh" class="ring-4 bg-green-300 px-6 py-1">searchUser</button>--}}
        <button wire:click="searchUser" class="ring-4 bg-green-300 px-6 py-1">searchUser</button>
    </div>

    <div class="m-2">
        <div>
            <div class="inline-block border-2 border-gray-400 w-12 p-1 text-center">
                ID
            </div>
            <div class="inline-block border-2 border-gray-400 w-48 p-1 text-center">
                NAME
            </div>
        </div>
        @foreach($users as $user)
            <div>
                <div class="inline-block border-2 border-gray-400 w-12 p-1 text-center">
                    {{ $user->id }}
                </div>
                <div class="inline-block border-2 border-gray-400 w-48 p-1 text-center">
                    {{ $user->name }}
                </div>
            </div>
        @endforeach
    </div>
</div>
