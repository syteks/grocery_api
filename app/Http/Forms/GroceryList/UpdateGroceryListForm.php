<?php

namespace App\Http\Forms\GroceryList;

use App\Http\Requests\GroceryList\UpdateGroceryListRequest;
use App\Models\GroceryList;

class UpdateGroceryListForm extends UpdateGroceryListRequest
{
    /**
     * Gets the updated grocery list.
     *
     * @param  \App\Models\GroceryList  $groceryList
     * @return \App\Models\GroceryList
     */
    public function handle(GroceryList $groceryList): GroceryList
    {
        $groceryList->update($this->safe()->toArray());

        return $groceryList->refresh();
    }
}
