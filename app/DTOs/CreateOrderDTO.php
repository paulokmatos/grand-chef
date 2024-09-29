<?php

declare(strict_types=1);

namespace App\DTOs;

readonly class CreateOrderDTO
{
    /**
     * @param CreateOrderProductDTO[] $products $products
     */
    public function __construct(public array $products)
    {
    }

    public static function fromArray(array $data): self
    {
        $products = [];

        foreach ($data['products'] as $product) {
            $products[] = CreateOrderProductDTO::fromArray($product);
        }

        return new self($products);
    }
}
