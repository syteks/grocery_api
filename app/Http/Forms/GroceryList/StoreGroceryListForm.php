<?php

namespace App\Http\Forms\GroceryList;

use App\Helpers\GroceryList as GroceryListHelper;
use App\Http\Requests\GroceryList\StoreGroceryListRequest;
use App\Models\GroceryList;

class StoreGroceryListForm extends StoreGroceryListRequest
{
    /**
     * Handles the creation of a grocery list.
     *
     * @return \App\Models\GroceryList
     */
    public function handle(): GroceryList
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $groceryList = GroceryList::create(
            $this->safe()->toArray()
            + [
                'sharing_code' => GroceryListHelper::generateUniqueSharingCode(),
                'created_by' => $user->id,
            ],
        );

        $groceryList->users()->attach($user);

        $groceryList->load('creator');

        return $groceryList;
    }
}
