
<div class="flex justify-center">
    <div class="w-6/12">
        <h1 class="my-10 text-3xl">Comment</h1>

        <div>
            {{ $newComment }}
        </div>

        <div class="m-4 flex">
            <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's your mind" wire:model.defer="newComment">
            <div class="py-2">
                <button class="p-2 bg-blue-500 w-20 rounded shadow text-white" wire:click="addComment">
                    Add
                </button>
            </div>
        </div>

        @foreach($comments as $comment)
        <div class="rounded border shadow p-3 my-2">
            <div class="flex justify-start my-2">
                <p class="font-bold text-lg ">
                    {{ $comment->id }}
                    {{ $comment->creator }}
                </p>
                <p class="mx-3 py-1 text-xs text-grey-500 font-semibold">
                    {{ $comment->created_at }}
                </p>
            </div>
            <p class="text-grey-800">
                {{ $comment->body }}
            </p>
        </div>
        @endforeach

    </div>
</div>
