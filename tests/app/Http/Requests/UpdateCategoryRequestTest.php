<?php

declare(strict_types=1);

namespace Tests\App\Http\Requests;

use App\Http\Requests\UpdateCategoryRequest;
use PHPUnit\Framework\TestCase;

class UpdateCategoryRequestTest extends TestCase
{
    public function test_ShouldValidateRules()
    {
        $this->assertEquals(['name' => ['required']], (new UpdateCategoryRequest())->rules());
    }
}
