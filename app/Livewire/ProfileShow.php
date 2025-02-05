<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ProfileShow extends Component
{
    public User $user;

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.profile-show');
    }
}
