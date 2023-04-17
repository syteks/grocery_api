<?php

namespace App\Http\Forms\GroceryListItem;

use App\Http\Requests\GroceryListItem\UpdateGroceryListItemRequest;
use App\Models\GroceryListItem;

class UpdateGroceryListItemForm extends UpdateGroceryListItemRequest
{
    /**
     * Updates the grocery list item if it was purchased or not.
     *
     * @param  \App\Models\GroceryListItem  $groceryListItem
     * @return \App\Models\GroceryListItem
     */
    public function handle(GroceryListItem $groceryListItem): GroceryListItem
    {
        $wasPurchasedData = [
            'purchased_by' => null,
            'was_purchased' => false,
        ];

        if ($this->was_purchased) {
            $wasPurchasedData = [
                'purchased_by' => auth()->user()->id,
                'was_purchased' => true,
            ];
        }

        $groceryListItem->update($wasPurchasedData);

        return $groceryListItem->refresh();
    }
}
