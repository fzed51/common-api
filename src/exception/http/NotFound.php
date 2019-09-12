<?php

namespace CommonApi\Exception\Http;

class NotFound extends \Exception
{
    public function __construct(string $type)
    {
        parent::__construct($type . " n'a pas été trouvé.");
        $this->code = 404;
    }
}
