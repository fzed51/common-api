<?php

namespace CommonApi\Exception\Http;

class InternalError extends \RuntimeException
{
    public function __construct($message)
    {
        parent::__construct("Erreur interne. " . $message);
        $this->code = 500;
    }
}
