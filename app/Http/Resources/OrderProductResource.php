<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\OrderProducts;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin OrderProducts */
class OrderProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'product_id'   => $this->product_id,
            'order_id'     => $this->order_id,
            'product_name' => $this->product->name,
            'price'        => $this->price,
            'amount'       => $this->amount,
        ];
    }
}
