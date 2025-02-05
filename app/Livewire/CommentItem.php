<?php

namespace App\Livewire;

use App\Livewire\Forms\EditComment;
use App\Models\Comment;
use Livewire\Component;

class CommentItem extends Component
{
    public Comment $comment;

    public bool $editing = false;

    public EditComment $form;

    public function updatedEditing($editing)
    {
        if ($editing) {
            $this->form->body = $this->comment->body;
        }
    }

    public function editComment()
    {
        $this->form->validate();

        $this->comment->update(
            $this->form->only('body')
        );

        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.comment-item');
    }
}
