<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status_id' => ['required', 'integer', 'in:1,2,3,4'],
        ];
    }

    public function messages(): array
    {
        return [
            'status_id.in' => 'Status ID must be one of 2: Approved, 3: Finished, 4: Cancelled',
        ];
    }
}
