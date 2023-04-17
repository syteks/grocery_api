<?php

namespace App\Http\Forms\User;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;

class UpdateUserForm extends UpdateUserRequest
{
    /**
     * Handles the user's updating request.
     *
     * @param  \App\Models\User  $user
     * @return \App\Models\User
     */
    public function handle(User $user): User
    {
        // Don't update the user if the given user doesn't match.
        abort_if(
            $user->id !== $this->user()->id,
            403,
            'Not enough permissions.',
        );

        $user->update([
            'username' => $this->username,
        ]);

        return $user->refresh();
    }
}
