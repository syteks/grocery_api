<?php

namespace App\Http\Controllers;

use App\Http\Forms\GroceryList\StoreGroceryListForm;
use App\Http\Forms\GroceryList\UpdateGroceryListForm;
use App\Http\Resources\GroceryListResource;
use App\Models\GroceryList;
use Illuminate\Http\JsonResponse;

class GroceryListController extends Controller
{
    /**
     * Gets all the grocery lists associated with the user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            GroceryListResource::collection(request()->user()->groceryLists),
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Forms\GroceryList\StoreGroceryListForm  $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreGroceryListForm $form): JsonResponse
    {
        return response()->json(new GroceryListResource($form->handle()));
    }

    /**
     * Shows a specific grocery list.
     *
     * @param  \App\Models\GroceryList  $groceryList
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(GroceryList $groceryList): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = request()->user();

        abort_if(
            $groceryList->users()->where('user_id', $user->id)->doesntExist(),
            403,
            'Not enough permissions.',
        );

        $groceryList->load('creator');

        return response()->json(new GroceryListResource($groceryList));
    }

    /**
     * Updates the grocery list.
     *
     * @param  \App\Http\Forms\GroceryList\UpdateGroceryListForm  $form
     * @param  \App\Models\GroceryList  $groceryList
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateGroceryListForm $form, GroceryList $groceryList): JsonResponse
    {
        abort_if(request()->user()->id !== $groceryList->created_by, 403);

        $groceryList->load('creator');

        return response()->json(new GroceryListResource($form->handle($groceryList)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroceryList  $groceryList
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(GroceryList $groceryList): JsonResponse
    {
        abort_if(
            auth()->user()->id !== $groceryList->created_by,
            403,
            'Not enough permissions',
        );

        $groceryList->delete();

        return response()->json('ok');
    }
}
