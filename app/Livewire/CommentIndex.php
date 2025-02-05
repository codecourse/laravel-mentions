<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateComment;
use App\Models\Comment;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CommentIndex extends Component
{
    public CreateComment $form;

    public function createComment()
    {
        $this->form->validate();

        auth()->user()->comments()->create($this->form->only('body'));

        $this->form->reset();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.comment-index', [
            'comments' => Comment::latest()->get()
        ]);
    }
}
