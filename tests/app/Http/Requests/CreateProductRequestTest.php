<?php

declare(strict_types=1);

namespace Tests\App\Http\Requests;

use App\Http\Requests\CreateProductRequest;
use Tests\TestCase;

class CreateProductRequestTest extends TestCase
{
    public function test_ShouldValidateRules()
    {
        $this->assertEquals([
            'name'        => ['required', 'string', 'min:3', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'price'       => ['required', 'numeric'],
        ], (new CreateProductRequest())->rules());
    }
}
