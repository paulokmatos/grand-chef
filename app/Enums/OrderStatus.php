<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatus: int
{
    case PENDING   = 1;
    case APPROVED  = 2;
    case FINISHED  = 3;
    case CANCELLED = 4;

    public static function toArray(): array
    {
        return [
            1 => 'pending',
            2 => 'approved',
            3 => 'finished',
            4 => 'cancelled',
        ];
    }
}
