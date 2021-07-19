<?php

namespace Exception;


use Throwable;

class NotfoundException extends \Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('not found', 404, $previous);
    }
}
