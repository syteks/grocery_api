<?php

namespace App\Http\Forms\User;

use App\Enums\User\Role;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StoreUserForm extends StoreUserRequest
{
    /**
     * @return \App\Models\User
     */
    public function handle(): User
    {
        $user = User::create([
            'username' => $this->username,
            'role' => Role::User,
            'is_authorized' => true,
            'code' => Str::random('8'),
            'token' => Hash::make(Str::random(80)),
        ]);

        return $user;
    }
}
