<?php

namespace App\Http\Forms;

use Illuminate\Validation\Rule;

class ProductForm
{
    public ?int $id = null;
    public ?int $category_id = null;
    public ?int $supplier_id = null;
    public string $code = '';
    public string $name = '';
    public float $price = 0.0;
    public int $stock = 0;
    public int $min_stock = 10;

    public function rules(): array
    {
        $uniqueCode = $this->id
            ? Rule::unique('products', 'code')->ignore($this->id)
            : Rule::unique('products', 'code');

        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'code' => ['required', 'string', 'max:64', $uniqueCode],
            'name' => ['required', 'string', 'max:191'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'min_stock' => ['required', 'integer', 'min:0'],
        ];
    }
}
