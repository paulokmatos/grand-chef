<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'products'              => ['required', 'array'],
            'products.*.product_id' => ['required', 'exists:products,id'],
            'products.*.price'      => ['required', 'numeric'],
            'products.*.amount'     => ['required', 'integer', 'min:1'],
        ];
    }
}
