<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditComment extends Form
{
    #[Rule('required')]
    public string $body = '';
}
