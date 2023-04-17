<?php

namespace App\Helpers;

use App\Models\GroceryList as GroceryListModel;
use Illuminate\Support\Str;

final class GroceryList
{
    /**
     * Generates a unique sharing code for the grocery list, so we are sure to not have the same code for 2 lists.
     *
     * @return string
     */
    public static function generateUniqueSharingCode(): string
    {
        $sharingCode = Str::random();

        return GroceryListModel::where('sharing_code', $sharingCode)->exists()
            ? self::generateUniqueSharingCode()
            : $sharingCode;
    }
}
