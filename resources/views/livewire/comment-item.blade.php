<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="comment-{{ $comment->id }}">
    <div class="p-6 text-gray-900 text-sm">
        <div class="text-gray-600">
            <span class="font-bold text-gray-900">{{ $comment->user->name }}</span> on {{ $comment->created_at }}
        </div>
        @if (!$editing)
            <p class="mt-1">
                @markdown($comment->body)
            </p>
        @else
            <form class="mt-1" wire:submit="editComment">
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
                    <x-textarea class="w-full" rows="3" x-ref="textarea" wire:model="form.body" />
                </div>

                <div>
                    <x-primary-button>Edit</x-primary-button>
                    <x-secondary-button wire:click="set('editing', false)">Cancel</x-secondary-button>
                </div>
            </form>
        @endif

        <div class="mt-2">
            <button class="text-sm text-indigo-500" wire:click="set('editing', true)">Edit</button>
        </div>
    </div>
</div>
