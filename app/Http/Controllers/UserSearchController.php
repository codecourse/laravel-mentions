<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function __invoke(Request $request)
    {
        return User::search($request->get('q', ''))
            //->where('username', 'LIKE', $request->get('q', '') . '%')
            ->get()
            ->map(fn (User $user) => [
                'key' => $user->name,
                'value' => $user->username,
            ]);
    }
}
