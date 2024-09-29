<?php

declare(strict_types=1);

namespace App\DTOs;

readonly class CreateOrderProductDTO
{
    public function __construct(
        public int $productId,
        public int $amount,
        public float $price,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['product_id'],
            $data['amount'],
            $data['price'],
        );
    }
}
