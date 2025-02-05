<?php

namespace App\Mentions;

use App\Models\User;

class Mentionables
{
    public static function get()
    {
        return User::get()
            ->map(fn (User $user) => [
                'key' => $user->name,
                'value' => $user->username
            ]);
    }
}
