<?php

declare(strict_types=1);

namespace Tests\App\Http\Requests;

use App\Http\Requests\UpdateOrderStatusRequest;
use Tests\TestCase;

class UpdateOrderStatusRequestTest extends TestCase
{
    public function test_ShouldValidateRules()
    {
        $this->assertEquals([
            'status_id' => ['required', 'integer', 'in:1,2,3,4'],
        ], (new UpdateOrderStatusRequest())->rules());
    }

    public function test_ShouldValidateMessages()
    {
        $this->assertEquals([
            'status_id.in' => 'Status ID must be one of 2: Approved, 3: Finished, 4: Cancelled',
        ], (new UpdateOrderStatusRequest())->messages());
    }
}
