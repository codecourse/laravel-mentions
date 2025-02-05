<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 text-sm">
        <div class="text-gray-600">
            <span class="font-bold text-gray-900">{{ $comment->user->name }}</span> on {{ $comment->created_at }}
        </div>
        <p class="mt-1">
            {{ $comment->body }}
        </p>
    </div>
</div>
