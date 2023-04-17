<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Http\Request;

final class UserToken
{
    /**
     * Authenticates the user that is matching the requests user token.
     *
     * @param  \Illuminate\Http\Request|null  $request
     * @return void
     */
    public static function authenticateUserToken(?Request $request = null): void
    {
        $request ??= request();

        $userToken = trim($request->headers->get('User-Token'));

        $user = User::firstWhere('token', $userToken);

        if (! $user) {
            abort(403, 'The given token is invalid.');
        }

        auth()->onceUsingId($user->id);
    }

    /**
     * Verifies that the given user matches the token found in the request.
     * If it doesn't match it will abort.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public static function verifyUserMatchesToken(User $user): void
    {
        abort_if(
            auth()->user()->id !== $user->id,
            403,
            'Invalid token.',
        );
    }
}
