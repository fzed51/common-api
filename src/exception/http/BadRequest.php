<?php

namespace CommonApi\Exception\Http;

class BadRequest extends \Exception
{
    public function __construct($message)
    {
        parent::__construct("Problème dans la requète. " . $message);
        $this->code = 400;
    }
}
