<?php

declare(strict_types=1);

namespace Tests\App\Enums;

use App\Enums\OrderStatus;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class OrderStatusTest extends TestCase
{
    public function test_ShouldReturnApprovedOnParseOrFail()
    {
        $enum = OrderStatus::parseOrFail(2);
        $this->assertEquals(OrderStatus::APPROVED, $enum);
    }

    public function test_ShouldThrowsExceptionWithInvalidOrderStatus()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Invalid status');
        OrderStatus::parseOrFail(22);
    }
}
