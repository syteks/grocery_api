<?php

namespace App\Http\Requests\GroceryListItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGroceryListItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                Rule::requiredIf($this->route('groceryListItem')),
                'string',
                'max:255',
            ],
            'was_purchased' => ['sometimes', 'boolean'],
        ];
    }
}
