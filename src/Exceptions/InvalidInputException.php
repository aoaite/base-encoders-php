<?php

namespace Aoaite\BaseEncoders\Exceptions;

use Exception;
use Throwable;

class InvalidInputException extends Exception
{
    public function __construct(string $message, int $code = 0, Throwable|null $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
