<?php

namespace App\Http\Forms\GroceryListItem;

use App\Http\Requests\GroceryListItem\StoreGroceryListItemRequest;
use App\Models\GroceryList;
use App\Models\GroceryListItem;
use App\Models\Item;

class StoreGroceryListItemForm extends StoreGroceryListItemRequest
{
    /**
     * Creates a new item in the grocery list.
     *
     * @param  \App\Models\GroceryList  $groceryList
     * @param  \App\Models\Item|null  $item
     * @return \App\Models\GroceryListItem
     */
    public function handle(GroceryList $groceryList, ?Item $item = null): GroceryListItem
    {
        $itemWasPurchasedData = [
            'purchased_by' => null,
            'was_purchased' => false,
        ];

        if ($this->was_purchased) {
            $itemWasPurchasedData = [
                'purchased_by' => auth()->user()->id,
                'was_purchased' => true,
            ];
        }

        if ($item) {
            return GroceryListItem::create(
                [
                    'grocery_list_id' => $groceryList->id,
                    'item_id' => $item->id,
                    'created_by' => auth()->user()->id,
                ] + $itemWasPurchasedData,
            );
        }

        $item = Item::create([
            'name' => $this->name,
        ]);

        return GroceryListItem::create(
            [
                'grocery_list_id' => $groceryList->id,
                'item_id' => $item->id,
                'created_by' => auth()->user()->id,
            ] + $itemWasPurchasedData,
        );
    }
}
