<?php

namespace CommonApi\Exception\Http;

class TokenNotValid extends \Exception
{
    public function __construct($message = "")
    {
        parent::__construct("Le jeton a expiré ou est invalide. " . $message);
        $this->code = 401;
    }
}
