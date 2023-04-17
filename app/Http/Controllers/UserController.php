<?php

namespace App\Http\Controllers;

use App\Enums\User\Role;
use App\Helpers\UserToken;
use App\Http\Forms\User\StoreUserForm;
use App\Http\Forms\User\UpdateUserForm;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Gets all the users that were created in the app.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = request()->user();

        abort_if(
            $user->role !== Role::Admin,
            403,
            'Resource not available',
        );

        return response()->json(
            UserResource::collection(User::all()),
        );
    }

    /**
     * Stores a new user in the system.
     *
     * @param  \App\Http\Forms\User\StoreUserForm  $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserForm $form): JsonResponse
    {
        $user = $form->handle();

        return response()->json(new UserResource($user));
    }

    /**
     * Gets the information of the given user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        UserToken::verifyUserMatchesToken($user);

        $user->load('groceryLists');

        return response()->json(new UserResource($user));
    }

    /**
     * Updates the given user with the given information.
     *
     * @param  \App\Http\Forms\User\UpdateUserForm  $form
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserForm $form, User $user): JsonResponse
    {
        UserToken::verifyUserMatchesToken($user);

        return response()->json(new UserResource($form->handle($user)));
    }

    /**
     * Destroys the given user from the system.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        UserToken::verifyUserMatchesToken($user);

        $user->delete();

        return response()->json('ok');
    }
}
