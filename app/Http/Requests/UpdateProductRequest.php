<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['string'],
            'category_id' => ['integer', 'exists:categories,id'],
            'price'       => ['numeric', 'min:0'],
        ];
    }
}
