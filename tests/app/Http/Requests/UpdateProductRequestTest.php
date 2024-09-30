<?php

declare(strict_types=1);

namespace Tests\App\Http\Requests;

use App\Http\Requests\UpdateProductRequest;
use Tests\TestCase;

class UpdateProductRequestTest extends TestCase
{
    public function test_ShouldValidateRules()
    {
        $this->assertEquals([
            'name'        => ['string'],
            'category_id' => ['integer', 'exists:categories,id'],
            'price'       => ['numeric', 'min:0'],
        ], (new UpdateProductRequest())->rules());
    }
}
