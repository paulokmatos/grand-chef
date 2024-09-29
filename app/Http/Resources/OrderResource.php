<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Order */
class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'status'      => $this->status->name,
            'status_id'   => $this->status_id,
            'total_price' => $this->total_price,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'products'    => $this->whenLoaded('products', function () {
                return OrderProductResource::collection($this->products);
            }),
        ];
    }
}
