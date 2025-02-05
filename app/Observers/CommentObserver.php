<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\User;

class CommentObserver
{
    public function created(Comment $comment)
    {
        $this->findAndSyncMentions(
            $comment
        );
    }

    public function updated(Comment $comment)
    {
        $this->findAndSyncMentions(
            $comment
        );
    }

    protected function findAndSyncMentions(Comment $comment)
    {
        preg_match_all(
            '(\@(?P<username>[a-zA-Z0-9\-\_]+))',
            $comment->body,
            $mentions,
            PREG_SET_ORDER
        );

        if (count($mentions) === 0) {
            return;
        }

        $comment->mentions()->sync(
            User::whereIn('username', collect($mentions)->pluck('username'))
                ->pluck('id')
                ->toArray()
        );
    }
}
