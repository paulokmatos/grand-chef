<?php

declare(strict_types=1);

namespace Tests\App\Http\Requests;

use App\Http\Requests\CreateCategoryRequest;
use PHPUnit\Framework\TestCase;

class CreateCategoryRequestTest extends TestCase
{
    public function test_ShouldValidateRules()
    {
        $this->assertEquals([
            'name' => ['required', 'string', 'min:3', 'max:255'],
        ], (new CreateCategoryRequest())->rules());
    }
}
