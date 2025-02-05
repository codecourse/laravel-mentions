
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Comments') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-3">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form wire:submit="createComment">
                    <div
                        x-data
                        x-init='
                            let tribute = new Tribute({
                                trigger: "@",
                                values: @json(App\Mentions\Mentionables::get()),
                                menuItemTemplate: (item) => {
                                    return "@" + item.original.value + " (" + item.original.key + ")"
                                }
                            })

                            tribute.attach($refs.textarea)
                        '
                    >
                        <x-textarea class="w-full" rows="4" wire:model="form.body" x-ref="textarea" />
                    </div>

                    <x-primary-button>
                        Post
                    </x-primary-button>
                </form>
            </div>
        </div>

        @foreach($comments as $comment)
            <livewire:comment-item :comment="$comment" :key="$comment->id" />
        @endforeach
    </div>
</div>
