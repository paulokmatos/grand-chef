<?php

declare(strict_types=1);

namespace App\Exceptions;

use DomainException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class InvalidStatusException extends DomainException
{
    public function __construct(string $message = '', int $code = Response::HTTP_NOT_ACCEPTABLE, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
