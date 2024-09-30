<?php

declare(strict_types=1);

namespace Tests\App\Http\Requests;

use App\Http\Requests\CreateOrderRequest;
use Tests\TestCase;

class CreateOrderRequestTest extends TestCase
{
    public function test_ShouldValidateRules()
    {
        $this->assertEquals([
            'products'              => ['required', 'array'],
            'products.*.product_id' => ['required', 'exists:products,id'],
            'products.*.price'      => ['required', 'numeric'],
            'products.*.amount'     => ['required', 'integer', 'min:1'],
        ], (new CreateOrderRequest())->rules());
    }
}
