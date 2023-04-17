<?php

namespace App\Http\Controllers;

use App\Http\Forms\GroceryListItem\StoreGroceryListItemForm;
use App\Http\Forms\GroceryListItem\UpdateGroceryListItemForm;
use App\Http\Resources\GroceryListItemResource;
use App\Models\GroceryList;
use App\Models\GroceryListItem;
use App\Models\Item;
use Illuminate\Http\JsonResponse;

class GroceryListItemController extends Controller
{
    /**
     * Stores a new item in the database, and it will be associated with the given grocery list.
     *
     * @param  \App\Http\Forms\GroceryListItem\StoreGroceryListItemForm  $form
     * @param  \App\Models\GroceryList  $groceryList
     * @param  \App\Models\Item|null  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreGroceryListItemForm $form, GroceryList $groceryList, Item $item = null): JsonResponse
    {
        abort_if(
            $groceryList->users()->where('users.id', auth()->user()->id)->doesntExist(),
            403,
            'Not enough permissions',
        );

        $groceryListItem = $form->handle($groceryList, $item);

        return response()->json(
            new GroceryListItemResource($groceryListItem),
        );
    }

    /**
     * Gets the information of the given item.
     *
     * @param  \App\Models\GroceryList  $groceryList
     * @param  \App\Models\GroceryListItem  $groceryListItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(GroceryList $groceryList, GroceryListItem $groceryListItem): JsonResponse
    {
        abort_if(
            $groceryList->users()->where('users.id', auth()->user()->id)->doesntExist(),
            403,
            'Not enough permissions',
        );

        abort_if(
            $groceryList->items()->where('grocery_list_item.id', $groceryListItem->id)->doesntExist(),
            403,
            'Item is not part of the list',
        );

        return response()->json(
            new GroceryListItemResource($groceryListItem),
        );
    }

    /**
     * Updates a grocery list item.
     *
     * @param  \App\Http\Forms\GroceryListItem\UpdateGroceryListItemForm  $form
     * @param  \App\Models\GroceryList  $groceryList
     * @param  \App\Models\GroceryListItem  $groceryListItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateGroceryListItemForm $form, GroceryList $groceryList, GroceryListItem $groceryListItem): JsonResponse
    {
        abort_if(
            $groceryList->users()->where('users.id', auth()->user()->id)->doesntExist(),
            403,
            'Not enough permissions',
        );

        return response()->json(
            new GroceryListItemResource($form->handle($groceryListItem)),
        );
    }

    /**
     * Removes the item from the database.
     *
     * @param  \App\Models\GroceryList  $groceryList
     * @param  \App\Models\GroceryListItem  $groceryListItem
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(GroceryList $groceryList, GroceryListItem $groceryListItem): JsonResponse
    {
        abort_if(
            $groceryList->users()->where('users.id', auth()->user()->id)->doesntExist(),
            403,
            'Not enough permissions',
        );

        $groceryListItem->delete();

        return response()->json('ok');
    }
}
