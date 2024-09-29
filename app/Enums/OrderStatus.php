<?php

declare(strict_types=1);

namespace App\Enums;

use RuntimeException;

enum OrderStatus: int
{
    case PENDING   = 1;
    case APPROVED  = 2;
    case FINISHED  = 3;
    case CANCELLED = 4;

    public static function parseOrFail(int $statusId): self
    {
        return match ($statusId) {
            1       => self::PENDING,
            2       => self::APPROVED,
            3       => self::FINISHED,
            4       => self::CANCELLED,
            default => throw new RuntimeException('Invalid status'),
        };
    }
}
