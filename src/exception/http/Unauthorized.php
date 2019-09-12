<?php

namespace CommonApi\Exception\Http;

class Unauthorized extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct("Une authentification est nécessaire pour accéder à la ressource. " . $message);
        $this->code = 401;
    }
}
